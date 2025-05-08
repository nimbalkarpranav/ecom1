@extends('BackEnd.admin.layout')
@section('content1')
<a href="customerForm" class="btn btn-primary mb-3">Add Category</a>
 <div class="table-responsive">
    <table
      id="add-row"
      class="display table table-striped table-hover"
    >
      <thead>
        <tr>
          <th>Name</th>
          <th>Phone</th>
          <th>Email</th>
          <th>Password</th>
          <th>Gender</th>
          <th>DOB</th>


        </tr>
      </thead>

      <tbody>
        @foreach($Customers as $contact)
        <tr>
          <td>{{ $contact->name }}</td>
          <td>{{ $contact->phone }}</td>
          <td>{{ $contact->email }}</td>
          <td>{{ $contact->password }}</td>
          <td>{{ $contact->Gender }}</td>
          <td>{{ $contact->Adderss }}</td>
           <td>{{ $contact->DOB }}</td>

        </tr>
        @endforeach
    </tbody>
    </table>
</div>
 @endsection
