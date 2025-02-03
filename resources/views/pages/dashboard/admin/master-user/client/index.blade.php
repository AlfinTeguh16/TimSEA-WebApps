@extends('layouts.master')

@section('content')

<section class="bg-white rounded-lg p-4">
    <div class="flex flex-col md:flex-row justify-between">
        <div class="py-3">
            <h1 class="font-medium text-2xl text-neutral-600">All Client Account</h1>
        </div>
        <div>
            <a href="/admin/create-user" class="flex items-center w-fit gap-x-2 p-3 bg-primary-500 text-white rounded-md">
                <i class="ph ph-plus-square text-lg"></i>
                <span>Create account</span>
            </a>
        </div>        
    </div>

    <!-- Search Input -->
    <div class="my-4 flex justify-between items-center ">
        <input type="text" id="tableSearch" name="search" 
            class="border border-gray-300 rounded-md px-4 py-2 w-1/3"
            placeholder="Search by Username, Email, or Company">
    </div>

    <!-- Table Users -->
    <table id="dataTable" class="table-auto w-full border-collapse border border-gray-300 rounded-xl">
        <thead class="bg-blue-500 text-white uppercase text-sm font-semibold">
            <tr>
                <th class="px-2 py-3">Number</th>
                <th class="px-6 py-3">Company/Client Name</th>
                <th class="px-6 py-3">Email</th>
                <th class="px-6 py-3">Username</th>
                <th class="px-6 py-3">Action</th>
            </tr>
        </thead>
        <tbody id="userTable" class="bg-white text-gray-700">
            <!-- Data populated via JavaScript -->
        </tbody>
    </table>

    <div id="paginationLinks" class="mt-4 flex justify-center">
        {{ $users->links() }} 
    </div>
</section>


<section id="alert-box" class="fixed inset-0 hidden items-center justify-center z-50 ">
    <div onclick="hideAlert()" class="absolute inset-0 bg-black opacity-50"></div>
    
    <div class="relative bg-white rounded-lg shadow-lg max-w-md w-full">
        <div class="bg-red-500 flex justify-center items-center py-4 rounded-t-lg">
            <i class="ph ph-warning text-white text-4xl"></i>
        </div>

        <div class="p-6 text-center">
            <h1 class="text-xl font-semibold text-gray-900 mb-3">Warning!</h1>
            <p class="text-gray-600 text-sm">
                Are you sure about block this user?
            </p>
        </div>

        <div class="flex justify-center gap-4 p-4 border-t">
            <form id="block-user-form" action="" method="POST">
                @csrf
                <button type="submit" id="confirm-btn" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition">
                    Confirm
                </button>
            </form>
            <button type="button" onclick="hideAlert()" id="review-btn" class="border border-gray-300 px-4 py-2 rounded-md hover:bg-gray-100 transition">
                Cancel
            </button>
        </div>
    </div>
</section>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
    function fetchUsers(query = '', page = 1) {
        $.ajax({
            url: "{{ route('search-users') }}",
            type: "GET",
            data: { q: query, page: page },
            success: function(response) {
                let tbody = $('#userTable');
                tbody.empty();

                if (response.data.length > 0) { 
                    $.each(response.data, function(index, user) {
                        let row = `
                            <tr class="hover:bg-gray-100">
                                <td class="px-2 py-4 text-center">${(response.current_page - 1) * response.per_page + index + 1}</td>
                                <td class="px-6 py-4 text-center">${user.company ? user.company : 'N/A'}</td>
                                <td class="px-6 py-4 text-center">${user.email}</td>
                                <td class="px-6 py-4 text-center">${user.username}</td>
                                <td class="px-6 py-4 text-white text-center">
                                    <div class="flex justify-center gap-2">
                                        <a href="/admin/edit-user/${user.id}" class="py-2 px-3 rounded bg-primary-500 text-white">
                                            <i class="ph ph-pencil-simple"></i>
                                        </a>

                                        <button type="button" onclick="showBlockAlert(${user.id})" class="py-2 px-3 rounded bg-red-500 text-white">
                                            <i class="ph ph-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        `;
                        tbody.append(row);
                    });

                    let paginationHtml = '';
                    if (response.prev_page_url) {
                        paginationHtml += `<a href="${response.prev_page_url}" class="pagination-link px-4 py-2 bg-gray-300 text-black rounded mr-2">Prev</a>`;
                    }
                    if (response.next_page_url) {
                        paginationHtml += `<a href="${response.next_page_url}" class="pagination-link px-4 py-2 bg-gray-300 text-black rounded ml-2">Next</a>`;
                    }
                    $('#paginationLinks').html(paginationHtml);
                } else {
                    tbody.append('<tr><td colspan="5" class="text-center py-4">Data is empty</td></tr>');
                    $('#paginationLinks').html('');
                }
            },
        });
    }

    fetchUsers();

    $('#tableSearch').on('keyup', function() {
        let searchValue = $(this).val();
        fetchUsers(searchValue, 1);
    });

    $(document).on('click', '.pagination-link', function(event) {
        event.preventDefault();
        let pageUrl = $(this).attr('href');
        let page = new URL(pageUrl).searchParams.get("page");
        let searchValue = $('#tableSearch').val();
        fetchUsers(searchValue, page);
    });
});


function showBlockAlert(userId) {
    const alertBox = document.getElementById('alert-box');
    const blockForm = document.getElementById('block-user-form');
    
    // Update form action with dynamic user ID
    blockForm.action = `/admin/block-user/${userId}`;
    alertBox.classList.remove('hidden');
    alertBox.classList.add('flex');
}

function hideAlert() {
    document.getElementById('alert-box').classList.add('hidden');
}

document.getElementById('review-btn').addEventListener('click', hideAlert);
</script>

@endsection

