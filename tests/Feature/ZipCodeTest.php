<?php

namespace Tests\Feature;

use App\Models\ZipCode;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ZipCodeTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
     /**
     * Testa a criação de um cep com sucesso.
     *
     * @return void
     */
    public function test_criacao_de_cep_com_sucesso()
    {
        // Crie dados aleatórios para um cep usando o Factory
        $zipcodeData = [
            'name' => $this->faker->zipcode,
        ];

        // Faça uma requisição POST para a rota de criação de cep
        $response = $this->postJson('/api/zipcodes', $zipcodeData);

        // Verifique se a resposta tem status 201 (Created)
        $response->assertStatus(201);

        // Verifique se a estrutura dos dados retornados está correta
        $response->assertJsonStructure([
            'id',
            'name',
            'created_at',
            'updated_at',
        ]);
    }
      /**
     * Testa a criação de um cep com sucesso.
     *
     * @return void
     */
    public function test_criacao_cep_com_falha()
    {
        $newData = [
            'name' => '',
            'country_id' => 99999,
        ];

        // Faça uma requisição POST para a rota de criação
        $response = $this->postJson('/api/zipcode', $newData);

        // Verifique se a resposta tem status 422
        $response->assertStatus(422);

        // Verifique se há erros de validação 
        $response->assertJsonValidationErrors(['name', 'state_id','country_id']);
    }

       /**
     * Testa a criação de um cep com sucesso.
     *
     * @return void
     */
    public function test_tentar_salvar_cep_com_mesmo_nome_falhar(){

      
        //Criar um teste
        $data  = ZipCode::factory()->create();
        $newData = [
            'name' => $data->name,
            'country_id' => $data->country_id
            
        ];

        // Faça uma requisição POST para a rota de criação
        $response = $this->postJson('/api/states', $newData);

        // Verifique se a resposta tem status 422
        $response->assertStatus(422);

        // Verifique se há erros de validação 
        $response->assertJsonValidationErrors(['name']);
    }
}
