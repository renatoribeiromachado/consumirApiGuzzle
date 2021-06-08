<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client As Guzzle;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Http;


class ProdutoController extends Controller
{
 
    private $token;

    public function __construct()
    {
        $auth = new Produto;
        $this->token = $auth->getToken();

    }

    public function index()
    {
       $guzzle = new Guzzle;
       $response = $guzzle->get('http://127.0.0.1:8000/api/produtos', [
           'headers' => [
                'Authorization' => "Bearer {$this->token}"
           ]
       ]);

        $titulo = 'Produtos Cadastrados';

        $produtos = json_decode($response->getBody())->data;
        return view('produtos.index', compact('titulo','produtos'));
        
    }

    public function create()
    {
        $titulo = "Cadastro de Produto";
        return view('produtos.create', compact('titulo'));
    }

    public function store(Request $request)
    {

        $data = [
            'codigo' => $request->codigo,
            'nome'   => $request->nome,
            'price'  => $request->price,
        ];

        $file = $request->imagem->getPathname();

        $guzzle = new Guzzle;

        $response = $guzzle->request('POST','http://127.0.0.1:8000/api/produtos', [
            
            'headers' => [
                'Authorization' => "Bearer {$this->token}"
            ],

            'query' => $data,

            'multipart' => [
                [
                    'name'     => 'imagem',
                    'contents' => fopen($file, 'r')
                ]
            ],
      
        ]); 

       //dd(json_decode($response->getBody()));
       return redirect('produtos')->with('success','Cadastrado com sucesso');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $guzzle = new Guzzle;
        $response = $guzzle->request('GET',"http://127.0.0.1:8000/api/produtos/{$id}", [
            
            'headers' => [
                'Authorization' => "Bearer {$this->token}"
            ],
        ]);
        
        $produto = json_decode($response->getBody())->data;
        $titulo = "Editando produto {$produto->nome}";

        return view('produtos.edit', compact('produto','titulo'));
    }

    public function update(Request $request, $id)
    {
        $data = [
            'codigo' => $request->codigo,
            'nome'   => $request->nome,
            'price'  => $request->price,
        ];

        $file = $request->imagem->getPathname();
        //dd($file);
        
        $guzzle = new Guzzle;

        $response = $guzzle->request('PUT',"http://127.0.0.1:8000/api/produtos/{$id}", [
            
            'headers' => [
                'Authorization' => "Bearer {$this->token}"
            ],

            'query' => $data,

            'multipart' => [
                [
                    'name'     => 'imagem',
                    'contents' => fopen($file, 'r')
                ]
            ],
      
        ]); 
        return redirect('produtos')->with('success','Editado com sucesso');  
    }

    public function destroy($id)
    {
        $guzzle = new Guzzle;

        $response = $guzzle->request('DELETE',"http://127.0.0.1:8000/api/produtos/{$id}", [
                        
            'headers' => [
                'Authorization' => "Bearer {$this->token}"
            ],

        ]); 
        return redirect('produtos')->with('success','Deletado com sucesso');  
    }
}
