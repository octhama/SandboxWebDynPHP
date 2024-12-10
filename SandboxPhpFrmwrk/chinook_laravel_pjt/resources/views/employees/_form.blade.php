<form action="{{ $action }}" method="POST">
    @csrf
    @if(isset($method) && $method !== 'POST')
        @method($method)
    @endif

    <div class="mb-3">
        <label for="LastName" class="form-label">Nom</label>
        <input type="text" name="LastName" id="LastName" class="form-control" value="{{ old('LastName', $employee->LastName ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label for="FirstName" class="form-label">Prénom</label>
        <input type="text" name="FirstName" id="FirstName" class="form-control" value="{{ old('FirstName', $employee->FirstName ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label for="Title" class="form-label">Titre</label>
        <input type="text" name="Title" id="Title" class="form-control" value="{{ old('Title', $employee->Title ?? '') }}">
    </div>

    <div class="mb-3">
        <label for="BirthDate" class="form-label">Date de naissance</label>
        <input type="date" name="BirthDate" id="BirthDate" class="form-control" value="{{ old('BirthDate', $employee->BirthDate ?? '') }}">
    </div>

    <div class="mb-3">
        <label for="Country" class="form-label">Pays</label>
        <input type="text" name="Country" id="Country" class="form-control" value="{{ old('Country', $employee->Country ?? '') }}" required>
    </div>

    <button type="submit" class="btn btn-primary">{{ $buttonText }}</button>
</form>
