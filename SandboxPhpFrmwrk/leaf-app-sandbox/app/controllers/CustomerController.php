<?php

namespace App\Controllers;

use App\Models\Customer;
class CustomerController extends \Leaf\Controller {

    // cettte fonction index sert a afficher la liste des utilisateurs de la base de données
    public function index() {
        $titre = 'Customers'; // pour le titre de la page
        $customers = Customer::all(); // pour afficher la liste des utilisateurs de la base de données
        render ("customer.index", compact("titre", "customers")); // render est une methode de la classe Controller qui permet d'afficher une vue
    }

    // une fonction create qui sert a afficher le formulaire d'inscription d'un nouvel utilisateur
    function create() {
        render('customer.create'); // render est une methode de la classe Controller qui permet d'afficher une vue
    }

    // une fonction store qui sert a créer un nouvel utilisateur et le redirige vers la page d'accueil
    function store() {
        $data = request()->postData();
        $customer = new Customer();
        $customer->FirstName = $data["FirstName"];
        $customer->LastName = $data["LastName"];
        $customer-City = $data["City"];
        $customer->Email = $data["Email"];
        $customer->save();
        response()->redirect('customer');
    }

    function show($id) {
        $customer = Customer::find($id);
        render('customer.show', compact('customer'));
    }

    function edit($id) {
        $customer = Customer::find($id);
        render('customer.edit', compact('customer'));
    }

    function update($id) {
        $data = request()->postData();
        $customer = Customer::find($id);
        $customer->FirstName = $data["FirstName"];
        $customer->LastName = $data["LastName"];
        $customer->City = $data["City"];
        $customer->Email = $data["Email"];
        $customer->save();
        response()->redirect('customer');
    }

    function destroy($id) {
        $customer = Customer::find($id);
        $customer->delete();
        response()->redirect('customer');
    }

    function search() {
        $search = request()->get('search');
        $customers = Customer::where('FirstName', 'like', "%$search%")->orWhere('LastName', 'like', "%$search%")->get();
        render('customer.index', compact('customers'));
    }

    function sort() {
        $sort = request()->get('sort');
        $customers = Customer::orderBy($sort)->get();
        render('customer.index', compact('customers'));
    }

    function filter() {
        $filter = request()->get('filter');
        $customers = Customer::where('City', $filter)->get();
        render('customer.index', compact('customers'));
}
