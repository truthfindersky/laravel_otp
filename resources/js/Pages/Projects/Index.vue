<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { ref, computed } from "vue";



// Form for adding projects
const projectForm = useForm({ name: "" });

const addProject = () => {
    projectForm.post(route("projects.store"), {
        onSuccess: () => projectForm.reset(),
    });
};

/* const deleteProject = (id) => {
    if (confirm("Are you sure you want to delete this project?")) {
        router.delete(route("projects.destroy", id));
    }
}; */

const deleteProject = (id) => {
    form.delete(route("project.destroy", id));
};

// Form for adding tasks
defineProps({ tasks: Array, projects: Array });

const form = useForm({
    title: "",
    project_id: "",
});

const isModalOpen = ref(false); // State to manage modal visibility

const openModal = () => {
    isModalOpen.value = true; // Show the modal
};

const closeModal = () => {
    isModalOpen.value = false; // Close the modal
};

const addTask = () => {
    form.post(route("task.store"), {
        onSuccess: () => {
            form.reset();
            closeModal(); // Close the modal after successful submission
        },
    });
};

const toggleTask = (id) => {
    form.patch(route("task.update", id));
};

const deleteTask = (id) => {
    form.delete(route("task.destroy", id));
};
</script>

<template>

    <Head title="Project" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Projects
            </h2>
        </template>

        <div class="max-w-6xl mx-auto p-6">
            <div class="grid grid-cols-12 gap-6">
                <!-- Project Section -->
                <div class="col-span-12 lg:col-span-4 bg-white p-6 rounded shadow">
                    <h1 class="text-xl font-bold mb-4">Projects</h1>

                    <form @submit.prevent="addProject" class="mb-4">
                        <input v-model="projectForm.name" type="text" placeholder="Project Name"
                            class="border p-2 rounded w-full" />
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-2 w-full">
                            Add Project
                        </button>
                    </form>

                    <ul class="space-y-2">
                        <li v-for="project in projects" :key="project.id"
                            class="flex justify-between items-center border p-2 rounded">
                            <span>{{ project.name }}</span>
                            <button @click="deleteProject(project.id)" class="bg-red-500 text-white px-2 py-1 rounded">
                                Delete
                            </button>
                        </li>
                    </ul>
                </div>





                 <!-- Task Section -->
                <div class="col-span-12 lg:col-span-8 bg-white p-6 shadow rounded">

                    <h1 class="text-xl font-bold mb-4">Task List</h1>

                    <!-- Button to open modal -->
                    <button @click="openModal" class="px-4 py-2 bg-blue-500 text-white rounded">
                        Add Task
                    </button>

                    <ul class="space-y-2 mt-4">
                        <li v-for="task in tasks" :key="task.id"
                            class="flex justify-between items-center bg-gray-100 p-2 rounded">
                            <input type="checkbox" :checked="task.completed" @change="toggleTask(task.id)"
                                class="mr-2" />

                            <span :class="{ 'line-through text-gray-500': task.completed }">
                                {{ task.title }}
                            </span>

                            <button @click="deleteTask(task.id)" class="text-red-500">Delete</button>
                        </li>
                    </ul>





                    <!-- Modal for adding task -->
                <div
                    v-if="isModalOpen"
                    class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50"
                >
                    <div class="bg-white p-6 rounded shadow-md w-96">
                        <h2 class="text-xl font-bold mb-4">Add Task</h2>

                        <!-- Task Form -->
                        <form @submit.prevent="addTask">
                            <div class="mb-4">
                                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                                <input
                                    v-model="form.title"
                                    id="title"
                                    type="text"
                                    placeholder="Enter title"
                                    class="w-full px-3 py-2 border rounded"
                                    required
                                />
                            </div>
                            <div class="mb-4">
                                <label for="project_id" class="block text-sm font-medium text-gray-700">Project</label>
                                <select
                                    v-model="form.project_id"
                                    id="project_id"
                                    class="w-full px-3 py-2 border rounded"
                                    required
                                >
                                    <option value="">Select a project</option>
                                    <option v-for="project in projects" :key="project.id" :value="project.id">
                                        {{ project.name }}
                                    </option>
                                </select>
                            </div>

                            <div class="flex justify-end mt-4">
                                <button
                                    type="submit"
                                    class="px-4 py-2 bg-blue-500 text-white rounded"
                                >
                                    Save
                                </button>
                                <button
                                    type="button"
                                    @click="closeModal"
                                    class="ml-2 px-4 py-2 bg-gray-300 text-gray-700 rounded"
                                >
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- End Modal -->


                </div>


                
            </div>
        </div>
    </AuthenticatedLayout>
</template>
