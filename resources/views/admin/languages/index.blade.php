@extends('admin.layouts.main')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('All Languages') }}</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('All Languages') }}</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.languages.create') }}" class="btn btn-primary space-x-2">
                        <i class="fas fa-plus"></i> {{ __('Create new ') }}
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table-languages">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Code') }}</th>
                            <th>{{ __('Default') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th class="text-right">{{ __('Action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($languages as $language)
                            <tr>
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td>{{ $language->name }}</td>
                                <td>{{ $language->lang }}</td>
                                <td>
                                    <span class="badge badge{{ $language->default === 1 ? '-primary' : '-warning'}}">
                                        {{ $language->default === 1 ? __('yes') : __('no')}}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge{{ $language->status === 1 ? '-success' : '-danger'}}">
                                        {{ $language->status === 1 ? __('active') : __('inactive')}}
                                    </span>
                                </td>
                                <td class="text-right">
                                    <a href="{{ route('admin.languages.edit', $language) }}"
                                       class="btn btn-primary mx-1">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a class="delete-item btn btn-danger" href="{{ route('admin.languages.destroy', $language) }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>
@endsection

@push('scripts')
    <script>
        $('#table-languages').dataTable({
            'columnDefs': [
                { 'sortable': false, 'targets': [2, 3] },
            ],
        })
    </script>
@endpush
