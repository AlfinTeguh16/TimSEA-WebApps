@extends('layouts.master')

@section('content')
<section class="bg-white rounded-lg shadow-md p-5 mx-auto">
    <!-- Breadcrumb -->
    <section class="flex flex-wrap gap-3 pb-4">
        <a href="/admin/super-team" class="text-neutral-400">All Projects</a>
        <p class="text-neutral-400">></p>
        <p class="text-neutral-400">Create New Projects</p>
        <p class="text-neutral-400">></p>
        <p class="font-semibold text-neutral-600">Complete Project Setup</p>
    </section>

    <!-- Header Section -->
    <div class="pb-5 flex flex-col md:flex-row md:justify-between">
        <h1 class="font-semibold mb-2 text-2xl text-neutral-600">Complete Project Setup</h1>
        <button type="submit" id="createProjectsBtn" class="w-full md:w-auto items-center justify-center gap-2 py-3 px-5 bg-primary-500 text-white rounded-md">
            <span>Create projects</span>
        </button>
    </div>

    <!-- Project Details -->
    <section>
        <div class="w-full">
            <label for="company" class="block text-neutral-500 mb-1">Company Name</label>
            <input id="company" name="company" readonly placeholder="{{ $project->company->company }}" class="w-full border px-2 py-3.5 rounded-md bg-neutral-100">
        </div>

        <div class="flex flex-col md:flex-row gap-3 w-full mt-3">
            <div class="w-full">
                <label for="project_name" class="block text-neutral-500 mb-1">Project Title</label>
                <input id="project_name" name="project_name" readonly placeholder="{{ $project->project_name }}" class="w-full border px-2 py-3.5 rounded-md bg-neutral-100">
            </div>
            <div class="w-full">
                <label for="category" class="block text-neutral-500 mb-1">Project Category</label>
                <input id="category" name="category" readonly placeholder="{{ $project->category }}" class="w-full border px-2 py-3.5 rounded-md bg-neutral-100">
            </div>
        </div>

        <div class="w-full mt-3">
            <label for="field" class="block text-neutral-500 mb-1">Description</label>
            <textarea id="field" name="field" readonly rows="10" cols="50" class="w-full border-2 rounded-md bg-neutral-100 p-2">{{ $project->description }}</textarea>
        </div>

        <!-- Team Selection Section -->
        <h1 class="text-neutral-600 mt-3 text-lg">Create Team</h1>
        <div class="flex flex-col md:flex-row gap-2 w-full">
            <div class="flex-1">
                <button onclick="openModal('alert-box')" class="py-[26px] flex flex-col justify-center items-center w-full bg-primary-400 hover:bg-primary-500 rounded-lg text-white font-semibold">
                    <i class="ph ph-user-circle-plus text-[50px]"></i>
                    <span>Select PM</span>
                </button>
            </div>
            <div class="flex-1">
                <button onclick="openModal('alert-box-Team')" class="py-[26px] flex flex-col justify-center items-center w-full bg-neutral-200 rounded-lg text-neutral-500 hover:bg-neutral-300 font-semibold">
                    <i class="ph ph-user-circle-plus text-[50px]"></i>
                    <span>Select Team</span>
                </button>
            </div>
        </div>

        <!-- Selected Team Table -->
        <div class="mt-4">
            <table id="tableFullTeam" class="w-full border rounded-lg">
                <thead class="bg-primary-500 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left">Profile</th>
                        <th class="px-6 py-3 text-left">Name</th>
                        <th class="px-6 py-3 text-left">Field</th>
                        <th class="px-6 py-3 text-left">Token</th>
                        <th class="px-6 py-3 text-left">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Dynamic content will be inserted here -->
                </tbody>
            </table>
        </div>
    </section>
</section>

<!-- PM Selection Modal -->
<section id="alert-box" class="fixed inset-0 hidden items-center justify-center z-50 bg-black bg-opacity-50">
    <div class="relative bg-white rounded-lg shadow-lg max-w-2xl w-full min-h-[80vh] overflow-auto p-4">
        <div class="flex justify-between items-center border-b-2 pb-4 mb-4">
            <h1 class="font-bold text-lg">Choose Project Manager</h1>
            <button onclick="closeModal('alert-box')" class="text-gray-600 hover:text-gray-900 text-2xl">&times;</button>
        </div>
        
        <div class="mb-4">
            <input type="text" id="tableSearchPM" class="w-full border rounded-md px-4 py-2" placeholder="Search Project Manager">
        </div>
        
        <table id="tablePM" class="w-full border rounded-lg">
            <thead class="bg-primary-500 text-white">
                <tr>
                    <th class="px-6 py-3 text-left">Profile</th>
                    <th class="px-6 py-3 text-left">Name</th>
                    <th class="px-6 py-3 text-left">Token</th>
                    <th class="px-6 py-3 text-left">Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- PM data will be loaded here -->
            </tbody>
        </table>
        
        <div id="paginationPM" class="mt-4 text-center"></div>
    </div>
</section>

<!-- Team Selection Modal -->
<section id="alert-box-Team" class="fixed inset-0 hidden items-center justify-center z-50 bg-black bg-opacity-50">
    <div class="relative bg-white rounded-lg shadow-lg max-w-2xl w-full min-h-[80vh] overflow-auto p-4">
        <div class="flex justify-between items-center border-b-2 pb-4 mb-4">
            <h1 class="font-bold text-lg">Choose Team Members</h1>
            <button onclick="closeModal('alert-box-Team')" class="text-gray-600 hover:text-gray-900 text-2xl">&times;</button>
        </div>
        
        <div class="mb-4">
            <input type="text" id="tableSearchTeam" class="w-full border rounded-md px-4 py-2" placeholder="Search Team Member">
        </div>
        
        <table id="tableTeam" class="w-full border rounded-lg">
            <thead class="bg-primary-500 text-white">
                <tr>
                    <th class="px-6 py-3 text-left">Profile</th>
                    <th class="px-6 py-3 text-left">Name</th>
                    <th class="px-6 py-3 text-left">Field</th>
                    <th class="px-6 py-3 text-left">Token</th>
                    <th class="px-6 py-3 text-left">Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Team data will be loaded here -->
            </tbody>
        </table>
        
        <div id="paginationTeam" class="mt-4 text-center"></div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
let imageUrl = "{{ asset('asset/img/default-user.png') }}";
let selectedUsers = [];

function openModal(modalId) {
    let modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.remove("hidden");
        modal.classList.add("flex");
        setTimeout(() => {
            modal.classList.remove("scale-95");
            modal.classList.add("scale-100");
        }, 10);
    } else {
        console.error("Modal with ID " + modalId + " not found.");
    }
}

function closeModal(modalId) {
    let modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.remove("scale-100");
        modal.classList.add("scale-95");
        setTimeout(() => {
            modal.classList.add("hidden");
            modal.classList.remove("flex");
        }, 200);
    } else {
        console.error("Modal with ID " + modalId + " not found.");
    }
}

function addToTeamTable(userId, profilePic, username, field, token) {
    if (!userId) {
        alert("Error: User ID is missing!");
        return;
    }
    if (selectedUsers.includes(userId)) {
        alert("User already selected!");
        return;
    }
    selectedUsers.push(userId);
    let tbody = $("#tableFullTeam tbody");
    let row = `
        <tr data-user-id="${userId}" class="border-b">
            <td class="px-6 py-3">
                <img src="${profilePic ? profilePic : imageUrl}" class="w-10 h-10 rounded-full" alt="Profile">
            </td>
            <td class="px-6 py-3">${username}</td>
            <td class="px-6 py-3">${field}</td>
            <td class="px-6 py-3">${token}</td>
            <td class="px-6 py-3">
                <button type="button" class="remove-user bg-red-500 text-white px-3 py-2 rounded">
                    Remove
                </button>
            </td>
        </tr>
    `;
    tbody.append(row);
}

$(document).ready(function() {
    // --- Fetch data untuk modal PM & Team (AJAX) ---
    function fetchPM(query = '', page = 1) {
        $.ajax({
            url: "{{ route('search-pm') }}",
            type: "GET",
            data: { q: query, page: page },
            success: function(response) {
                let tbody = $('#tablePM tbody');
                tbody.empty();
                if (response.data.length > 0) {
                    $.each(response.data, function(index, pm) {
                        let row = `
                            <tr data-user-id="${pm.talent_id}">
                                <td class="px-6 py-3">
                                    <img src="${pm.profile_picture ? pm.profile_picture : imageUrl}" class="w-10 h-10 rounded-full" alt="Profile">
                                </td>
                                <td class="px-6 py-3">${pm.username}</td>
                                <td class="px-6 py-3">${pm.token}</td>
                                <td class="px-6 py-3">
                                    <button type="button" class="select-pm bg-primary-500 text-white px-3 py-2 rounded"
                                        data-user-id="${pm.talent_id}"
                                        data-profile-pic="${pm.profile_picture ? pm.profile_picture : imageUrl}"
                                        data-username="${pm.username}"
                                        data-token="${pm.token}">
                                        Select
                                    </button>
                                </td>
                            </tr>
                        `;
                        tbody.append(row);
                    });
                    // Pagination (jika ada)
                    let paginationHtml = '';
                    if (response.prev_page_url) {
                        paginationHtml += `<a href="${response.prev_page_url}" class="pagination-link-pm px-4 py-2 bg-gray-300 text-black rounded mr-2">Prev</a>`;
                    }
                    if (response.next_page_url) {
                        paginationHtml += `<a href="${response.next_page_url}" class="pagination-link-pm px-4 py-2 bg-gray-300 text-black rounded ml-2">Next</a>`;
                    }
                    $('#paginationPM').html(paginationHtml);
                } else {
                    tbody.append('<tr><td colspan="4" class="text-center py-4">No Project Manager Found</td></tr>');
                    $('#paginationPM').html('');
                }
            }
        });
    }

    function fetchTeam(query = '', page = 1) {
        $.ajax({
            url: "{{ route('search-team') }}",
            type: "GET",
            data: { q: query, page: page },
            success: function(response) {
                let tbody = $('#tableTeam tbody');
                tbody.empty();
                if (response.data.length > 0) {
                    $.each(response.data, function(index, team) {
                        let formattedField = team.field.replace(/_/g, ' ');
                        let row = `
                            <tr data-user-id="${team.talent_id}">
                                <td class="px-6 py-3">
                                    <img src="${team.profile_picture ? team.profile_picture : imageUrl}" class="w-10 h-10 rounded-full" alt="Profile">
                                </td>
                                <td class="px-6 py-3">${team.username}</td>
                                <td class="px-6 py-3">${formattedField}</td>
                                <td class="px-6 py-3">${team.token}</td>
                                <td class="px-6 py-3">
                                    <button type="button" class="select-team bg-primary-500 text-white px-3 py-2 rounded"
                                        data-user-id="${team.talent_id}"
                                        data-profile-pic="${team.profile_picture ? team.profile_picture : imageUrl}"
                                        data-username="${team.username}"
                                        data-field="${formattedField}"
                                        data-token="${team.token}">
                                        Select
                                    </button>
                                </td>
                            </tr>
                        `;
                        tbody.append(row);
                    });
                    let paginationHtml = '';
                    if (response.prev_page_url) {
                        paginationHtml += `<a href="${response.prev_page_url}" class="pagination-link-team px-4 py-2 bg-gray-300 text-black rounded mr-2">Prev</a>`;
                    }
                    if (response.next_page_url) {
                        paginationHtml += `<a href="${response.next_page_url}" class="pagination-link-team px-4 py-2 bg-gray-300 text-black rounded ml-2">Next</a>`;
                    }
                    $('#paginationTeam').html(paginationHtml);
                } else {
                    tbody.append('<tr><td colspan="5" class="text-center py-4">No Team Member Found</td></tr>');
                    $('#paginationTeam').html('');
                }
            }
        });
    }

    // Load data pertama kali
    fetchPM();
    fetchTeam();

    // Event pencarian
    $('#tableSearchPM').on('keyup', function() {
        fetchPM($(this).val(), 1);
    });
    $('#tableSearchTeam').on('keyup', function() {
        fetchTeam($(this).val(), 1);
    });

    // Pagination event untuk PM
    $(document).on('click', '.pagination-link-pm', function(event) {
        event.preventDefault();
        let page = new URL($(this).attr('href')).searchParams.get("page");
        fetchPM($('#tableSearchPM').val(), page);
    });
    // Pagination event untuk Team
    $(document).on('click', '.pagination-link-team', function(event) {
        event.preventDefault();
        let page = new URL($(this).attr('href')).searchParams.get("page");
        fetchTeam($('#tableSearchTeam').val(), page);
    });

    // Event untuk menambahkan PM ke tim
    $(document).on("click", ".select-pm", function() {
        let button = $(this);
        let userId = button.data("user-id");
        let profilePic = button.data("profile-pic");
        let username = button.data("username");
        let token = button.data("token");

        addToTeamTable(userId, profilePic, username, "Project Manager", token);
        closeModal("alert-box");
    });

    // Event untuk menambahkan Team ke tim
    $(document).on("click", ".select-team", function() {
        let button = $(this);
        let userId = button.data("user-id");
        let profilePic = button.data("profile-pic");
        let username = button.data("username");
        let field = button.data("field");
        let token = button.data("token");

        addToTeamTable(userId, profilePic, username, field, token);
        closeModal("alert-box-Team");
    });

    // Event untuk menghapus user dari tabel full team
    $(document).on("click", ".remove-user", function() {
        let row = $(this).closest("tr");
        let userId = row.data("user-id");
        selectedUsers = selectedUsers.filter(id => id !== userId);
        row.remove();
    });

    // Event untuk mengirimkan data ke database saat tombol "Create Projects" diklik
    $("#createProjectsBtn").on("click", function() {
        let projectData = {
            project_id: "{{ $project->id }}",
            users: []
        };

        $("#tableFullTeam tbody tr").each(function() {
            let userId = $(this).data("user-id");
            projectData.users.push({ user_id: userId });
        });

        $.ajax({
            url: "{{ route('store-project-team') }}",
            type: "POST",
            headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" },
            data: projectData,
            success: function(response) {
                window.location.href = "/admin/super-team";
            },
            error: function(xhr) {
                alert("Error: " + xhr.responseText);
            }
        });
    });
});
</script>

@endsection