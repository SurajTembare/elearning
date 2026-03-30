
@extends('admin.master')
@section('content')

<div class="content-wrapper">

    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid text-center">
            <h1 class="m-0 text-success fw-bold">📞 Contact Management</h1>
            <p class="text-muted">Manage and view all user inquiries in one place</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="container-fluid">

            <div class="card shadow-lg border-0 rounded-3 mt-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Contact List</h4>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped mb-0 align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th style="width: 60px;">ID</th>
                                    <th>Name</th>
                                    <!-- <th>Phone</th> -->
                                    <th>Email</th>
                                    <th>Message</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($contacts as $contact)
                                <tr>
                                    <td>{{ $contact->id }}</td>
                                    <td>{{ $contact->name }}</td>
                                    <td>{{ $contact->email }}</td>
                                    <!-- <td>{{ $contact->message }}</td> -->
                                    <td>
                                        <span title="{{ $contact->message }}">
                                            {{ Str::limit($contact->message, 40) }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-3">
                                        No contact messages found.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
