<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\System\User\Empresa;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        /* Requisição para buscar os dados relacionados ao cnpj */
        $url = "https://publica.cnpj.ws/cnpj/" . preg_replace("/[^0-9]/", "", $request->cnpj_raiz); // Passando a url com o cnpj passado
        $curl = curl_init($url); // Inciando o curl
        curl_setopt($curl, CURLOPT_URL, $url); // Fazendo o curl
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // Fazendo o curl
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); // Para possíveis debugs
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // Para possíveis debugs
        curl_close($curl); // Fechando o curl
        $dados = json_decode(curl_exec($curl)); // Decodifiando dados do curl

        if (isset($dados->status) && $dados->status == 400) {
            return redirect(route('register'))->with('problema_cnpj', 'Cnpj inválido. Houve uma falha na busca. Tente novamente em outro momento.');
        } else {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            Empresa::create([
                // Informações básicas da empresa
                'cnpj_raiz' => preg_replace("/[^0-9]/", "", $dados->cnpj_raiz),
                'razao_social' => $dados->razao_social,
                'capital_social' => preg_replace('/\D/', '', $dados->capital_social),
                'nome_fantasia' => $dados->estabelecimento->nome_fantasia,
                'situacao_cadastral' => $dados->estabelecimento->situacao_cadastral == 'Ativa' ? 1 : 0,
                'data_inicio_atividade' => Carbon::parse($dados->estabelecimento->data_inicio_atividade)->format('Y-m-d'),

                // Endereço da empresa
                "logradouro" => $dados->estabelecimento->logradouro,
                "numero" => $dados->estabelecimento->numero,
                "complemento" => $dados->estabelecimento->complemento,
                "bairro" => $dados->estabelecimento->bairro,
                "cep" => $dados->estabelecimento->cep,

                // Contato
                "ddd1" => preg_replace("/[^0-9]/", "", $dados->estabelecimento->ddd1),
                "telefone1" => preg_replace("/[^0-9]/", "", $dados->estabelecimento->telefone1),

                // Especificando as formatações para "apenas números" nos campos que possivelmente virão nulos
                "ddd2" => $dados->estabelecimento->ddd2 ? preg_replace("/[^0-9]/", "", $dados->estabelecimento->ddd2) : null,
                "telefone2" => $dados->estabelecimento->telefone2 ? preg_replace("/[^0-9]/", "", $dados->estabelecimento->telefone2) : null,

                // Chave estrangeira
                'user_id' => $user->id
            ]);
        }

        event(new Registered($user));
        Auth::login($user);
        return redirect(RouteServiceProvider::HOME);
    }
}
