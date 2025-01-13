<div class="relative overflow-x-auto shadow-md sm:rounded-lg mx-6">
    <div class="text-center">
        <input type="text" class="" id="search" placeholder="Search tasks">
        <select id="status-filter">
            <option value="">All Status</option>
            <option value="pending">Pending</option>
            <option value="In Progress">In Progress</option>
            <option value="completed">Completed</option>
        </select>
        <input type="date" id="due_date-filter">
        <button id="filter-button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Filter</button>
    </div>
    <table id="task-list" class="w-full text-sm text-left rtl:text-right text-gray-500 ">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
            <tr>
                <th scope="col" class="px-6 py-3">
                    sno
                </th>
                <th scope="col" class="px-6 py-3">
                    Title
                </th>
                <th scope="col" class="px-6 py-3">
                    Status
                </th>
                <th scope="col" class="px-6 py-3">
                    Description
                </th>
                <th scope="col" class="px-6 py-3">
                   Created By
                </th>
                <th scope="col" class="px-6 py-3">
                    date
                 </th>
                <th scope="col" class="px-6 py-3">
                    Edit
                </th>
                <th scope="col" class="px-6 py-3">
                    delete
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $item)
                <tr class="bg-white border-b hover:bg-gray-50">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ $loop->iteration }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $item->title }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $item->status }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $item->description }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $item->created_by ." User" }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $item->due_date}}
                    </td>
                    <td class="px-6 py-4 ">
                        <a href="{{ route('task.editForm', ['id' => $item->id]) }}"
                            class="font-medium text-blue-600 hover:underline">Edit</a>
                    </td>
                    <td class="px-6 py-4 ">
                        <a href="{{ route('task.delete', ['id' => $item->id]) }}"
                            class="font-medium text-red-600 hover:underline">Delete</a>
                    </td>
                </tr>

            @empty
                <tr aria-colspan="6"> data not Found</tr>
            @endforelse



        </tbody>
    </table>
    <div id="pagination" class="">
        {!! $data->links() !!}
    </div>
</div>

@push('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        // Handle filter button click
        $('#filter-button').click(function() {
           // $('#pagination').empty();
            fetchTasks();
        });

        
        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault(); 
            var page = $(this).attr('href').split('page=')[1];
            fetchTasks(page);
        });

        // Function to fetch tasks
        function fetchTasks(page = 1) {
            let search = $('#search').val();
            let status = $('#status-filter').val();
            let due_date = $('#due_date-filter').val();
            let per_page = 2;

            $.ajax({
                url: '/api/tasks',
                type: 'GET',
                data: {
                    search: search,
                    status: status,
                    due_date: due_date,
                    per_page: per_page,
                    page: page
                },
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token') 
                },
                success: function(response) {
                   
                    let tasksHtml = '';
                    $.each(response.tasks, function(index, task) {
                        tasksHtml += `
                            <tr class="bg-white border-b hover:bg-gray-50">
                                 <td class="px-6 py-4">${task.id}</td>
                                <td class="px-6 py-4">${task.title}</td>
                                <td class="px-6 py-4">${task.status}</td>
                                <td class="px-6 py-4">${task.description}</td>
                                <td class="px-6 py-4">${task.created_by}</td>
                                <td class="px-6 py-4">${task.due_date}</td>
                                  <td class="px-6 py-4 ">
                        <a href="{{ route('task.editForm', ['id' => $item->id]) }}"
                            class="font-medium text-blue-600 hover:underline">Edit</a>
                    </td>
                    <td class="px-6 py-4 ">
                        <a href="{{ route('task.delete', ['id' => $item->id]) }}"
                            class="font-medium text-red-600 hover:underline">Delete</a>
                    </td>
                            </tr>
                        `;
                    });
                    $('#task-list tbody').html(tasksHtml);
                   
                    $('#pagination').html(response.pagination);
                },
                error: function(xhr, status, error) {
                    alert("An error occurred.");
                }
            });
        }

        
      //  fetchTasks();
    });
</script>
@endpush