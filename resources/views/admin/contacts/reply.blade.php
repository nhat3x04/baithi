@extends('layoutadmin.master')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <h1 class="page-header">Trả lời liên hệ</h1>
        <form action="{{ route('admin.contacts.reply', $contact->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="subject">Chủ đề</label>
                <input type="text" name="subject" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="message">Nội dung</label>
                <textarea name="message" class="form-control" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Gửi</button>
        </form>
    </div>
</div>
@endsection
