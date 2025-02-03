@extends('layouts.app')

@section('content')
<h1>add</h1>
<form action="{{ route('expenses.store') }}" method="POST">
@csrf
<label>date</label>
<input type="date" name="date" class="form-control" required>

<label>amount</label>
<input type="number" name="amount" class="form-control" required>

<label>category</label>
<input type="text" name="category" class="form-control" required>

<label>memo</label>
<textarea name="memo" class="form-control"></textarea>

<button type="submit" class="btn btn-primary mt-3">add</button>
</form>