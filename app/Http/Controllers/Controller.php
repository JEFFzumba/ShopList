<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Lists;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    //Before Login
        public function cadastroForms(Request $request)
        {
            $novoUsuario = new User;
            $this->validate($request,[
                'name'=>'required',
                'email'=>'required',
                'password'=>'required',
            ],[
                'name.required'=>'Os campos marcados com * são obrigatorios',
                'email.required'=>'Os campos marcados com * são obrigatorios',
                'password.required'=>'Os campos marcados com * são obrigatorios',
            ]);
            $novoUsuario->name = $request->name;
            if(!empty(user::where('email',$request->email)->first())){
            return redirect()->back()->with('danger','E-mail já cadastrado!');
            }
            $novoUsuario->email = $request->email;
            $novoUsuario->password = Hash::make($request->password);
        /* //Upload de imagem
                if($request->hasfile('foto') && $request->file('foto')->isValid()){
                //Pega a imagem
                $requestImagem=$request->foto;
                //pega a extensão
                $extension=$requestImagem->extension();
                //cria o nome da imagem
                $imagemName=md5($requestImagem->getClientOriginalName().strtotime("now")).".".$extension;
                //move para a pasta das imagens
                $requestImagem->move(public_path('img'),$imagemName);
                //salva no bd
                $novoUsuario->foto=$imagemName;
                }*/
            $novoUsuario->save();    
            return redirect('/')->with('msg','Cadastro realizado com sucesso!');
        }
    //Login
        public function login()
        {
            return view('signup');
        }
        public function loginForms(Request $request)
        {
            $this->validate($request,[
                'email'=>'required',
                'password'=>'required'
            ],[
                //'required' => 'A :attribute é um campo obrigartorio!',
                'email.required'=>'O campo Email é obrigatorio',
                'password.required'=>'O campo Senha é obrigatorio',
                
            ]);
            $usuario=User::where('email',$request->email)->first(); 
            if($usuario && Hash::check($request->password,$usuario->password)){
                Auth::loginUsingId($usuario->id);
                return redirect('/index');
            }else{
                return redirect()->back()->with('danger','E-mail ou senha invalida!');
            }
        }
    
    //middle login
        public function indexSenha()
        {
            return view('password_reset');            
        }
        public function esqueceuSenhaFormsEmail(Request $request)
        {
            $email=$request->email;
            $usuario=User::where('email','like', '%'.$email.'%')->first();
            if(empty($usuario)){
                return redirect()->back()->with('danger','Esse usuario não existe!');
            }
            return view('password_resetPasswprd',['entidade'=>$usuario]);
        }
        public function esqueceuSenhaForms (Request $request)
        {
            User::findOrFail($request->entidade)->update([
                'password'=>Hash::make($request->password),
            ]);  
            return redirect('/');
        }
    //after login
        public function index()
        {
            $usuario=auth()->user();
            $suasListas=Lists::where('idCriador',$usuario->id)->get();
            return view('home',['suasListas'=>$suasListas]);
        }
}
