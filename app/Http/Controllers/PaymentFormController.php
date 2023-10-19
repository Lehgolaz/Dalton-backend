<?php

namespace App\Http\Controllers;

use App\Models\PaymentForm;
use App\Http\Requests\StorePaymentFormRequest;
use App\Http\Requests\UpdatePaymentFormRequest;

class PaymentFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $formaPagamentos = PaymentForm::all();
        return view('forma-pagamento.index', compact('formaPagamentos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forma-pagamento.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePaymentFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePaymentFormRequest $request)
    {
        // Valide os dados do formulário, se necessário
        $request->validate([
            'nome' => 'required|string',
            'descricao' => 'nullable|string',
        ]);

        FormaPagamento::create($request->all());

        return redirect()->route('forma-pagamento.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaymentForm  $paymentForm
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentForm $paymentForm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaymentForm  $paymentForm
     * @return \Illuminate\Http\Response
     */
    public function edit(FormaPagamento $formaPagamento)
    {
        return view('forma-pagamento.edit', compact('formaPagamento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePaymentFormRequest  $request
     * @param  \App\Models\PaymentForm  $paymentForm
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePaymentFormRequest $request, FormaPagamento $formaPagamento)
    {
        // Valide os dados do formulário, se necessário
        $request->validate([
            'nome' => 'required|string',
            'descricao' => 'nullable|string',
        ]);

        $formaPagamento->update($request->all());

        return redirect()->route('forma-pagamento.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentForm  $paymentForm
     * @return \Illuminate\Http\Response
     */
    public function destroy(FormaPagamento $formaPagamento)
    {
        $formaPagamento->delete();
        return redirect()->route('forma-pagamento.index');
    }
}
