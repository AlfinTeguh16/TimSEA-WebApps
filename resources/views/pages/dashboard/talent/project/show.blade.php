@extends('layouts.master')

@section('content')
<section class="flex flex-col lg:flex-row gap-2">
    <section class="bg-white rounded-lg shadow-md p-5 mx-auto w-full">
        <!-- Breadcrumb -->
        <section class="flex flex-wrap gap-3 pb-4">
            <a href="/talent/dashboard" class="text-neutral-400">Dashboard</a>
            <p class="text-neutral-400">></p>
            <p class="text-neutral-400">Project Detail</p>
        </section>

        <!-- Header Section -->
        <div class="pb-5 flex flex-col md:flex-row md:justify-between">
            <h1 class="font-semibold mb-2 text-2xl text-neutral-600">Project Detail</h1>
        </div>

        <!-- Project Details -->
        <section>
            <div class="w-full">
                <label for="company" class="block text-neutral-500 mb-1">Company Name</label>
                <input id="company" name="company" readonly value="{{ $project->company->company }}" class="w-full border px-2 py-3.5 rounded-md bg-neutral-100">
            </div>

            <div class="flex flex-col md:flex-row gap-3 w-full mt-3">
                <div class="w-full">
                    <label for="project_name" class="block text-neutral-500 mb-1">Project Title</label>
                    <input id="project_name" name="project_name" readonly value="{{ $project->project_name }}" class="w-full border px-2 py-3.5 rounded-md bg-neutral-100">
                </div>
                <div class="w-full">
                    <label for="category" class="block text-neutral-500 mb-1">Project Category</label>
                    <input id="category" name="category" readonly value="{{ $project->category }}" class="w-full border px-2 py-3.5 rounded-md bg-neutral-100">
                </div>
            </div>

            <div class="w-full mt-3">
                <label for="field" class="block text-neutral-500 mb-1">Description</label>
                <textarea id="field" name="field" readonly rows="10" cols="50" class="w-full border-2 rounded-md bg-neutral-100 p-2">{{ $project->description }}</textarea>
            </div>

        </section>

        <section id="task" class="mt-5">
            <div class="flex flex-col md:flex-row justify-between">
                <h1 class="text-neutral-600 text-xl py-2">Task List</h1>
                <div  class=" flex justify-end gap-4">
                    <div>
                        <button class="px-3 py-2 bg-primary-100 border-2 border-primary-400 text-primary-400 rounded-lg">
                            {{$project->status}}
                        </button>
                    </div>

                </div>
            </div>

            <div class="flex flex-row gap-3">
                <span id="completionPercentage" class="py-2 text-neutral-700 font-semibold">{{ $completionRate }}%</span>
                <div class="bg-gray-200 rounded-sm h-6 w-full mt-2">
                    <div id="completionProgress" class="bg-gradient-to-r from-secondary-500 to-primary-500 h-6 rounded-sm transition-all duration-300"
                         style="width: {{ $completionRate }}%;">
                    </div>
                </div>
            </div>
            
            <div>
                <table class="w-full mt-2">
                    <thead>
                        <tr class="border-b">
                            <th class="text-left text-neutral-500 py-2">ToDo</th>
                            <th class="text-right text-neutral-500 py-2">Deadline</th>
                        </tr>
                    </thead>
                    <tbody id="todoTasks">
                        @forelse ($tasks as $task)
                            <tr class="border-b" data-task-id="{{ $task->id }}">
                                <td class="py-2 flex items-center gap-2">
                                    <input type="checkbox" class="w-5 h-5 border-gray-300 rounded"
                                           data-task-id="{{ $task->id }}" onchange="updateTaskStatus(this)">
                                    <span class="task-title text-neutral-700">Task Name: {{ $task->task_title }}</span>
                                </td>
                                <td class="py-2 text-right text-neutral-500">{{ \Carbon\Carbon::parse($task->deadline)->format('d/m/Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="py-2 text-center text-neutral-500">No tasks available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div>
                <h1 class="text-lg font-semibold text-neutral-600 mt-4">Done</h1>
                <table class="w-full mt-2">
                    <thead>
                        <tr class="border-b">
                            <th class="text-left text-neutral-500 py-2">Task</th>
                            <th class="text-right text-neutral-500 py-2">Deadline</th>
                        </tr>
                    </thead>
                    <tbody id="doneTasks">
                        @forelse ($doneTasks as $task)
                            <tr class="border-b" data-task-id="{{ $task->id }}">
                                <td class="py-2 flex items-center gap-2">
                                    <input type="checkbox" class="w-5 h-5 border-gray-300 rounded"
                                           data-task-id="{{ $task->id }}" checked onchange="updateTaskStatus(this)">
                                    <span class="task-title text-gray-500 line-through">Task Name: {{ $task->task_title }}</span>
                                </td>
                                <td class="py-2 text-right text-neutral-500">{{ \Carbon\Carbon::parse($task->deadline)->format('d/m/Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="py-2 text-center text-neutral-500">No completed tasks</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            
            
        </section>
    </section>

    <section class="bg-white rounded-lg shadow-md p-5 mx-auto w-1/3">
        {{-- Header --}}
        <div class="pb-5 flex flex-col md:flex-row md:justify-between">
            <h1 class="font-semibold mb-2 text-2xl text-neutral-600">Team Information</h1>
        </div>
    
        <div>
            {{-- Project Manager --}}
            <div class="mt-4">
                <h2 class="text-sm font-semibold text-neutral-600">Project Manager</h2>
                @if ($projectManager)
                    <div class="mt-2 bg-gray-100 p-3 rounded-lg flex items-center gap-4">
                        <img src="{{ $projectManager->profile_picture ?? asset('asset/img/default-user.png') }}" 
                            class="w-10 h-10 rounded-full" alt="Profile">
                        <div>
                            <h3 class="text-neutral-800 font-semibold">{{ $projectManager->username }}</h3>
                            <p class="text-neutral-500 text-sm">{{ ucwords(str_replace('_', ' ', $projectManager->field)) }}</p>
                        </div>
                    </div>
                @else
                    <p class="text-neutral-500 mt-2">No Project Manager Found.</p>
                @endif
            </div>
    
            {{-- Team Members --}}
            <div class="mt-6">
                <h2 class="text-sm font-semibold text-neutral-600">Team Members</h2>
                @if ($teamMembers && count($teamMembers) > 0)
                    @foreach ($teamMembers as $member)
                        <div class="mt-2 bg-gray-100 p-4 rounded-lg flex items-center gap-4">
                            <img src="{{ $member->profile_picture ?? asset('asset/img/default-user.png') }}" 
                                class="w-10 h-10 rounded-full" alt="Profile">
                            <div>
                                <h3 class="text-neutral-800 font-semibold">{{ $member->username }}</h3>
                                <p class="text-neutral-500 text-sm">{{ ucwords(str_replace('_', ' ', $member->field)) }}</p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-neutral-500 mt-2">No Team Members Assigned.</p>
                @endif
            </div>
        </div>
    </section>
    
</section>


<script>

function updateTaskStatus(checkbox) {
    let taskId = checkbox.dataset.taskId;
    let newStatus = checkbox.checked ? "completed" : "in progress";

    // Simpan nilai persentase saat ini sebelum update
    let currentPercentage = document.getElementById("completionPercentage").innerText;

    fetch(`/tasks/update-status/${taskId}`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({ status: newStatus })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            moveTaskRow(taskId, newStatus);

            // Gunakan nilai sebelumnya selama loading, lalu update setelah delay 300ms
            setTimeout(() => {
                updateCompletionPercentage(data.completionRate);
            }, 300);
        } else {
            alert("Failed to update task status");
            checkbox.checked = !checkbox.checked;
        }
    })
    .catch(error => console.error("Error updating task status:", error));
}

// Fungsi untuk memperbarui progress bar dengan delay untuk mencegah "undefined"
function updateCompletionPercentage(completionRate) {
    let progressBar = document.getElementById("completionProgress");
    let percentageText = document.getElementById("completionPercentage");

    // Pastikan tidak menampilkan "undefined" selama delay
    percentageText.innerText = percentageText.innerText || "0%"; // Gunakan nilai sebelumnya

    setTimeout(() => {
        progressBar.style.width = completionRate + "%";
        percentageText.innerText = completionRate + "%";
    }, 250); // Tambahkan delay 250ms agar tidak menampilkan "undefined"
}


// Fungsi untuk memindahkan task ke tabel yang sesuai
function moveTaskRow(taskId, status) {
    let row = document.querySelector(`tr[data-task-id="${taskId}"]`);
    if (!row) return;

    if (status === "completed") {
        document.getElementById("doneTasks").appendChild(row);
        row.classList.add("bg-green-100");
        row.querySelector("span.task-title").classList.add("line-through", "text-gray-500");
    } else {
        document.getElementById("todoTasks").appendChild(row);
        row.classList.remove("bg-green-100");
        row.querySelector("span.task-title").classList.remove("line-through", "text-gray-500");
    }

    setTimeout(updateCompletionPercentage, 200); // Pastikan perubahan DOM terjadi sebelum menghitung
}


</script>
@endsection