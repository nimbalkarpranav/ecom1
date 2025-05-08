@extends('BackEnd.admin.layout')
@section('content1')

<div class="container py-4">
    <table
      id="add-row"
      class="display table table-striped table-hover"
    >
      <thead>
        <tr>
          <th>Name</th>
          <th>LastName</th>
          <th>Email</th>
          <th>Message</th>
        </tr>
      </thead>

      <tbody>
        @foreach($contacts as $contact)
        <tr>
          <td>{{ $contact->name }}</td>
          <td>{{ $contact->phone }}</td>
          <td>{{ $contact->Email }}</td>
          <td>{{ $contact->date }}</td>

        </tr>
        @endforeach
    </tbody>
    </table>
</div>
 @endsection
