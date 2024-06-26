@extends('layoutadmin.master')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <h1 class="page-header">Danh sách liên hệ</h1>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Nội dung</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contacts as $contact)
                <tr>
                    <td>{{ $contact->id }}</td>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->message }}</td>
                    <td>{{ $contact->status == 'pending' ? 'Chưa trả lời' : 'Đã trả lời' }}</td>
                    <td>
                        <a href="{{ route('admin.contacts.showReplyForm', $contact->id) }}" class="btn btn-primary">Trả lời</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
