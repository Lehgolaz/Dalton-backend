<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PaymentForm>
 */
class PaymentFormFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            FormaPagamentoFactory::new()->count(5)->create();

            // Verificando se os registros foram criados corretamente
            $this->assertEquals(5, FormaPagamento::count());
    
            // Acessando os registros fictícios e realizando asserções
            $formaPagamento = FormaPagamento::first();
            $this->assertNotNull($formaPagamento);
            $this->assertNotEmpty($formaPagamento->nome);
            $this->assertNotEmpty($formaPagamento->descricao);
    
            // Você pode continuar realizando outras asserções de acordo com seus testes
        ];
    }
}