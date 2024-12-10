<!-- resources/views/customers/_form.blade.php -->
<form action="{{ $action }}" method="POST">
    @csrf
    @if(isset($method) && $method !== 'POST')
        @method($method)
    @endif

    <div class="mb-3">
        <label for="FirstName" class="form-label">Prénom</label>
        <input
            type="text"
            name="FirstName"
            id="FirstName"
            class="form-control"
            value="{{ old('FirstName', $customer->FirstName ?? '') }}"
            required
        >
    </div>

    <div class="mb-3">
        <label for="LastName" class="form-label">Nom</label>
        <input
            type="text"
            name="LastName"
            id="LastName"
            class="form-control"
            value="{{ old('LastName', $customer->LastName ?? '') }}"
            required
        >
    </div>

    <div class="mb-3">
        <label for="Email" class="form-label">Email</label>
        <input
            type="email"
            name="Email"
            id="Email"
            class="form-control"
            value="{{ old('Email', $customer->Email ?? '') }}"
            required
        >
    </div>

    <button type="submit" class="btn btn-primary">{{ $buttonText }}</button>
</form>
