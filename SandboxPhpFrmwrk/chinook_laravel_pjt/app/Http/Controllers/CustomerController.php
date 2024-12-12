<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller{
    public function index()
    {
        // Permet d'afficher tous les clients dans la page d'accueil
        $customers = Customer::all();
        return view('customers.index', compact('customers')); // compact permet d'afficher les variables dans la vue index
    }

    public function create()
    {
        return view('customers.create'); // permet d'afficher la vue create
    }

    public function store(Request $request)
    {
        $request->validate([
            'FirstName' => 'required|string|max:255', // Permet de valider les champs du formulaire en utilisant des règles de validation
            'LastName' => 'required|string|max:255',
            'Email' => 'required|email|max:255|unique:customers:email', // Permet de valider que l'email est unique dans la base de données
        ]);

        Customer::create($request->all()); // Permet de créer un nouveau client dans la base de données avec les données du formulaire
        return redirect()->route('customers.index')->with('success', 'Client ajouté avec succès !'); // redirection vers la page index si le client est ajouté
    }

    // Permet d'afficher un client dans la page d'accueil
    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer')); // permet d'afficher la vue show
    }

    // Permet de modifier un client dans la page d'accueil
    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    // Permet de modifier un client dans la page d'accueil
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'FirstName' => 'required|string|max:255',
            'LastName' => 'required|string|max:255',
            'Email' => 'required|email|max:255',
        ]);

        $customer->update($request->all());
        return redirect()->route('customers.index')->with('success', 'Client modifié avec succès !'); // redirection vers la page index si la modification est effectuée
    }

    // Permet de supprimer un client dans la page d'accueil
    public function destroy(Customer $customer)
    {
        $customer->delete(); // permet de supprimer le client dans la base de données
        return redirect()->route('customers.index')->with('success', 'Client supprimé avec succès !');
    }
}
