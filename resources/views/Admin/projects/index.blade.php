@extends('admin.layouts.base')

@section('contents')
    @if (session('delete_success'))
        @php $project = session('delete_success') @endphp
        <div class="alert alert-danger">
            The Project "{{ $project->title }}" has moved to the trash
        </div>
    @endif

    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th scope="col">Title</th>
                <th scope="col">Author</th>
                <th scope="col">Creation Date</th>
                <th scope="col">Last Update</th>
                <th scope="col">Collaborators</th>
                <th scope="col">Description</th>
                <th scope="col">Technologies</th>
                <th scope="col">Type</th>
                <th scope="col">Link</th>
                <th class="w-25" scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
                <tr>
                    <th scope="row">{{ $project->title }}</th>
                    <td>{{ $project->author }}</td>
                    <td>{{ $project->creation_date }}</td>
                    <td>{{ $project->last_update }}</td>
                    <td>{{ $project->collaborators }}</td>
                    <td>{{ $project->description }}</td>
                    <td>
                        @foreach ($project->technologies as $technology)
                            <a
                                href="{{ route('admin.technology.show', ['technology' => $technology]) }}">{{ $technology->name }}</a>
                        @endforeach
                    </td>
                    <td><a href="{{ route('admin.type.show', ['type' => $project->type]) }}">{{ $project->type->name }}</a>
                    </td>
                    <td><a href="{{ $project->link_github }}">Link</a></td>

                    <td>
                        <a class="btn btn-primary"
                            href="{{ route('admin.project.show', ['project' => $project]) }}">View</a>
                        <a class="btn btn-warning"
                            href="{{ route('admin.project.edit', ['project' => $project]) }}">Edit</a>
                        <button type="button" class="btn btn-danger js-delete" data-bs-toggle="modal"
                            data-bs-target="#deleteModal" data-id="{{ $project->slug }}">
                            Delete
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteModalLabel">Delete confirmation</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <form action="" data-template="{{ route('admin.project.destroy', ['project' => '***']) }}"
                        method="post" class="d-inline-block" id="btn-confirm-delete">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger">Yes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Bootstrap paginator --}}
    {{-- {{ $projects->links() }} --}}
@endsection
