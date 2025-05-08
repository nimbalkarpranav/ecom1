@extends('BackEnd.admin.layout')
@section('content1')

<div class="container mt-5">
  <h2>Add Slider Content</h2>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <form action="" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
      <label for="heading">Slider Heading</label>
      <input type="text" name="title" class="form-control" required>
    </div>

    <div class="form-group">
      <label for="description">Slider Description</label>
      <textarea name="description" class="form-control" rows="3" required></textarea>
    </div>

    <div class="form-group">
      <label for="btn_text">Button Text</label>
      <input type="text" name="btn_text" class="form-control" required>
    </div>

    <div class="form-group">
      <label for="btn_link">Button Link (URL)</label>
      <input type="text" name="btn_link" class="form-control" required>
    </div>

    <div class="form-group">
      <label for="image">Slider Image</label>
      <input type="file" name="image" class="form-control-file" required>
    </div>

    <button type="submit" class="btn btn-primary mt-3">Add Slider</button>
  </form>
</div>

@endsection
