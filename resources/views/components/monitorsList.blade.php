    <hr class="bg border-2 border-top border" />

    @if($categorizedMonitors === null || count($categorizedMonitors) === 0)
        <br>
        <h3>No monitors found.</h3>
    @else

        @foreach($categorizedMonitors as $category)
            <h4>{{ $category['category'] }}</h4>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>URL</th>
                        <th>Category</th>
                        <th>Added Date</th>
                        <th>Updated Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($category['sites'] as $site)
                        <tr>
                            <td>{{ $site->name }}</td>
                            <td>{{ $site->url }}</td>
                            <td>{{ $site->category }}</td>
                            <td>{{ $site->created_at->format('d/m/Y') }}</td>
                            <td>{{ $site->updated_at->format('d/m/Y') }}</td>
                            <td>
                                <button onClick="showUpdateModal('{{ $site->id }}','{{ $site->name }}','{{ $site->url }}','{{ $site->category }}')" class="btn btn-warning"><i class="bi bi-pencil"></i></button>
                                <a href="/monitor/{{ $site->id }}/delete" class="btn btn-danger"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <br> <br>
            <hr class="bg border-2 border-top border" />

        @endforeach
    @endif
