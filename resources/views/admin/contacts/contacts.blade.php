@extends('layout.master')
@section('content')
<div class="container">
    <h2>Contact Submissions</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
                <tr>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->subject }}</td>
                    <td>{{ $contact->message }}</td>
                    <td>{{ $contact->created_at }}</td>
                    <td>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#replyModal{{ $contact->id }}">Reply</button>
                    </td>
                </tr>
                
                <!-- Reply Modal -->
                <div class="modal fade" id="replyModal{{ $contact->id }}" tabindex="-1" role="dialog" aria-labelledby="replyModalLabel{{ $contact->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="replyModalLabel{{ $contact->id }}">Reply to {{ $contact->name }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('admin.contacts.reply', $contact->id) }}" method="post">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="reply-subject">Subject</label>
                                        <input type="text" class="form-control" id="reply-subject" name="subject" placeholder="Subject" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="reply-message">Message</label>
                                        <textarea class="form-control" id="reply-message" name="message" rows="5" placeholder="Your message" required></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Send Reply</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- End Reply Modal -->
            @endforeach
        </tbody>
    </table>
</div>
@endsection
