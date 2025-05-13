<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GymKeeper - Мой сайт</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/papaparse/5.3.2/papaparse.min.js"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
        .menu-item-active {
            background-color: #4f46e5; /* indigo-600 */
            color: white;
        }
        .menu-item-active svg {
            color: white;
        }
        .filter-button-active {
            background-color: #4f46e5; /* indigo-600 */
            color: white;
        }
         .exercise-card {
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }
        .exercise-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        #sidebar-overlay {
            transition: opacity 0.3s ease-in-out;
        }
        /* Стили для загрузчика */
        .loader {
            border: 4px solid #f3f3f3; /* Light grey */
            border-top: 4px solid #4f46e5; /* Indigo */
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin: 20px auto;
        }
        .button-loader {
            border: 2px solid #f3f3f3;
            border-top: 2px solid #4f46e5;
            border-radius: 50%;
            width: 1em;
            height: 1em;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen overflow-hidden">
        <aside class="w-64 bg-gray-800 text-gray-300 flex flex-col fixed inset-y-0 left-0 transform md:relative md:translate-x-0 -translate-x-full transition-transform duration-300 ease-in-out z-30 shadow-lg" id="sidebar">
            <div class="h-16 flex items-center justify-center bg-gray-900 flex-shrink-0">
                <h1 class="text-xl font-bold text-white">GymKeeper</h1>
            </div>
            <nav class="flex-grow p-4 space-y-1 overflow-y-auto">
                <a href="#" id="nav-diary" class="flex items-center px-3 py-2.5 rounded-lg hover:bg-gray-700 hover:text-white transition-colors group text-sm">
                    <svg class="h-5 w-5 mr-3 text-gray-400 group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    Дневник
                </a>
                <a href="#" id="nav-workouts" class="flex items-center px-3 py-2.5 rounded-lg hover:bg-gray-700 hover:text-white transition-colors group text-sm">
                    <svg class="h-5 w-5 mr-3 text-gray-400 group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/></svg>
                    Тренировки
                </a>
                <a href="#" id="nav-exercises" class="flex items-center px-3 py-2.5 rounded-lg hover:bg-gray-700 hover:text-white transition-colors group text-sm">
                    <svg class="h-5 w-5 mr-3 text-gray-400 group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    Упражнения
                </a>
                <a href="#" id="nav-programs" class="flex items-center px-3 py-2.5 rounded-lg hover:bg-gray-700 hover:text-white transition-colors group text-sm">
                    <svg class="h-5 w-5 mr-3 text-gray-400 group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                    Программы
                </a>
                <a href="#" id="nav-measurements" class="flex items-center px-3 py-2.5 rounded-lg hover:bg-gray-700 hover:text-white transition-colors group text-sm">
                    <svg class="h-5 w-5 mr-3 text-gray-400 group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    Измерения
                </a>
                <a href="#" id="nav-statistics" class="flex items-center px-3 py-2.5 rounded-lg hover:bg-gray-700 hover:text-white transition-colors group text-sm">
                    <svg class="h-5 w-5 mr-3 text-gray-400 group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                    Статистика
                </a>
                 <a href="#" id="nav-settings" class="flex items-center px-3 py-2.5 rounded-lg hover:bg-gray-700 hover:text-white transition-colors group text-sm">
                    <svg class="h-5 w-5 mr-3 text-gray-400 group-hover:text-white transition-colors" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.646.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.24-.438.613-.43.992a6.759 6.759 0 0 1 0 1.25c.008.379.137.752.43.992l1.004.827a1.125 1.125 0 0 1 .26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.333.183-.582.495-.646.87l-.212 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.646-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.759 6.759 0 0 1 0-1.25c-.007-.379-.137-.752-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.646-.87l.212-1.28Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>
                    Настройки
                </a>
            </nav>
            <div class="p-4 border-t border-gray-700 flex-shrink-0">
                <div class="flex items-center">
                    <img class="h-8 w-8 rounded-full object-cover" src="https://placehold.co/100x100/7F9CF5/EBF4FF?text=User" alt="User Avatar">
                    <div class="ml-3">
                        <p class="text-sm font-medium text-white">Имя Пользователя</p>
                        <a href="#" class="text-xs text-indigo-400 hover:text-indigo-300">Профиль</a>
                    </div>
                </div>
            </div>
        </aside>

        <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-20 md:hidden hidden opacity-0"></div>

        <main class="flex-1 flex flex-col overflow-hidden">
            <header class="md:hidden flex justify-between items-center p-4 bg-white shadow-md flex-shrink-0 sticky top-0 z-10">
                <h1 class="text-lg font-semibold text-gray-700">GymKeeper</h1>
                <button id="mobileMenuButton" class="text-gray-600 hover:text-gray-800 focus:outline-none p-2 -mr-2">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </header>

            <div id="page-content" class="flex-1 overflow-y-auto p-4 sm:p-6">
                <div id="current-workout-view" class="hidden">
                    </div>
                <div id="diary-view" class="hidden">
                     </div>
                <div id="workouts-view" class="hidden">
                     </div>
                <div id="exercises-view">
                     </div>
                <div id="programs-view" class="hidden">
                     </div>
                <div id="measurements-view" class="hidden">
                     </div>
                <div id="statistics-view" class="hidden">
                     </div>

                 <div id="settings-view" class="hidden">
                     <h2 class="text-xl sm:text-2xl font-semibold text-gray-800 mb-4 sm:mb-6">Настройки</h2>
                     <div class="bg-white p-6 rounded-lg shadow-lg space-y-8">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Основные настройки</h3>
                            <p class="text-sm text-gray-500 mb-4">Здесь будут основные настройки приложения.</p>
                            <div class="mt-4">
                                <label for="theme-select" class="block text-sm font-medium text-gray-700">Тема оформления</label>
                                <select id="theme-select" name="theme" class="mt-1 block w-full max-w-xs pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md shadow-sm">
                                    <option>Светлая</option>
                                    <option>Темная</option>
                                    <option>Системная</option>
                                </select>
                            </div>
                        </div>

                        <div class="border-t border-gray-200 pt-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Импорт данных из CSV</h3>
                            <p class="text-sm text-gray-500 mb-4">Загрузите файл лога тренировок в формате CSV для импорта в ваш дневник.</p>
                            <form id="import-csv-form">
                                <div>
                                    <label for="import-csv-file" class="block text-sm font-medium text-gray-700">
                                        Выберите CSV файл
                                    </label>
                                    <div class="mt-1 flex items-center">
                                        <input type="file" name="import-csv-file" id="import-csv-file" accept=".csv, text/csv" class="block w-full max-w-md text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 cursor-pointer border border-gray-300 rounded-md shadow-sm">
                                    </div>
                                    <p class="mt-1 text-xs text-gray-500">Только файлы формата .csv</p>
                                </div>
                                <div class="mt-4">
                                    <button type="submit" id="import-csv-button" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50" disabled>
                                        <span id="import-csv-button-text">Импортировать CSV</span>
                                        <div id="import-csv-loader" class="button-loader ml-2 hidden"></div>
                                    </button>
                                </div>
                            </form>
                            <div id="import-csv-status" class="mt-3 text-sm"></div>
                        </div>
                     </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // --- DOM Elements (остаются без изменений) ---
        const sidebar = document.getElementById('sidebar');
        const mobileMenuButton = document.getElementById('mobileMenuButton');
        const sidebarOverlay = document.getElementById('sidebar-overlay');
        const exerciseFiltersContainer = document.getElementById('exercise-filters');
        const exerciseListContainer = document.getElementById('exercise-list-container');
        const exerciseLoader = document.getElementById('exercise-loader');
        const noExercisesMessage = document.getElementById('no-exercises-message');
        const exerciseSearchInput = document.getElementById('exercise-search');
        const paginationControls = document.getElementById('pagination-controls');
        const allPageDivs = document.querySelectorAll('#page-content > div');
        const navLinks = document.querySelectorAll('aside nav a');

        // Элементы для импорта CSV
        const importCsvForm = document.getElementById('import-csv-form');
        const importCsvFileInput = document.getElementById('import-csv-file');
        const importCsvButton = document.getElementById('import-csv-button');
        const importCsvButtonText = document.getElementById('import-csv-button-text');
        const importCsvLoader = document.getElementById('import-csv-loader');
        const importCsvStatusDiv = document.getElementById('import-csv-status');
        let selectedCsvFile = null;

        // --- API Configuration (остается без изменений) ---
        const API_BASE_URL = 'http://gym.test/api/v1';
        const GIF_BASE_URL = 'https://placeholder.gymkeeper-api.com/gifs/';

        // --- Application State (остается без изменений) ---
        let currentExercisePage = 1;
        let currentMuscleGroupId = 'all';
        let currentSearchTerm = '';
        let currentActiveNavId = 'nav-exercises';

        // --- Sidebar Logic (остается без изменений) ---
        function openSidebar() { /* ... */ }
        function closeSidebar() { /* ... */ }
        if (mobileMenuButton) { /* ... */ }
        if (sidebarOverlay) { /* ... */ }
        // (Код для Sidebar остается таким же, как в предыдущей версии)
        function openSidebar() {
            if (sidebar && sidebarOverlay) {
                sidebar.classList.remove('-translate-x-full');
                sidebarOverlay.classList.remove('hidden');
                requestAnimationFrame(() => { sidebarOverlay.classList.remove('opacity-0'); });
            }
        }
        function closeSidebar() {
             if (sidebar && sidebarOverlay) {
                sidebar.classList.add('-translate-x-full');
                sidebarOverlay.classList.add('opacity-0');
                setTimeout(() => { sidebarOverlay.classList.add('hidden'); }, 300);
            }
        }
        if (mobileMenuButton) {
            mobileMenuButton.addEventListener('click', (e) => {
                e.stopPropagation();
                if (sidebar.classList.contains('-translate-x-full')) openSidebar();
                else closeSidebar();
            });
        }
        if (sidebarOverlay) {
            sidebarOverlay.addEventListener('click', closeSidebar);
        }

        // --- API Data Fetching (остается без изменений) ---
        async function fetchData(url) { /* ... */ }
        // (Код для fetchData остается таким же)
        async function fetchData(url) {
            try {
                const response = await fetch(url);
                if (!response.ok) {
                    const errorData = await response.json().catch(() => ({ message: response.statusText }));
                    throw new Error(`HTTP error! status: ${response.status}, message: ${errorData.message || 'Unknown error'}`);
                }
                return await response.json();
            } catch (error) {
                console.error("Ошибка при загрузке данных:", error);
                if(noExercisesMessage && exerciseListContainer && exerciseListContainer.contains(noExercisesMessage)) {
                    noExercisesMessage.textContent = `Ошибка загрузки: ${error.message}. Попробуйте позже.`;
                    noExercisesMessage.classList.remove('hidden');
                }
                if(exerciseLoader && exerciseListContainer && exerciseListContainer.contains(exerciseLoader)) exerciseLoader.classList.add('hidden');
                return null;
            }
        }


        // --- Muscle Group Filters (остается без изменений) ---
        async function loadMuscleGroups() { /* ... */ }
        const allFilterButton = document.querySelector('#exercise-filters button[data-filter="all"]');
        if (allFilterButton) { /* ... */ }
        // (Код для loadMuscleGroups и allFilterButton остается таким же)
        async function loadMuscleGroups() {
            if (!exerciseFiltersContainer) return;
            const muscleGroups = await fetchData(`${API_BASE_URL}/muscle-groups`);
            if (muscleGroups) {
                const allButton = exerciseFiltersContainer.querySelector('button[data-filter="all"]');
                const dynamicButtons = exerciseFiltersContainer.querySelectorAll('button:not([data-filter="all"])');
                dynamicButtons.forEach(btn => btn.remove());

                muscleGroups.forEach(group => {
                    const button = document.createElement('button');
                    button.className = 'filter-button px-3 py-1.5 sm:px-4 sm:py-2 text-xs sm:text-sm font-medium text-gray-700 bg-white rounded-lg shadow hover:bg-gray-50';
                    button.textContent = group.name_ru;
                    button.setAttribute('data-filter', group.id);
                    button.addEventListener('click', () => {
                        document.querySelectorAll('#exercise-filters .filter-button').forEach(btn => btn.classList.remove('filter-button-active'));
                        button.classList.add('filter-button-active');
                        currentMuscleGroupId = group.id.toString();
                        currentExercisePage = 1;
                        loadExercises();
                    });
                    exerciseFiltersContainer.appendChild(button);
                });
            }
        }
        if (allFilterButton) {
            allFilterButton.addEventListener('click', () => {
                 document.querySelectorAll('#exercise-filters .filter-button').forEach(btn => btn.classList.remove('filter-button-active'));
                 allFilterButton.classList.add('filter-button-active');
                 currentMuscleGroupId = 'all';
                 currentExercisePage = 1;
                 loadExercises();
            });
        }

        // --- Exercise Loading and Rendering (остается без изменений) ---
        async function loadExercises() { /* ... */ }
        // (Код для loadExercises остается таким же)
        async function loadExercises() {
            if (!exerciseListContainer || !exerciseLoader || !noExercisesMessage || !paginationControls) return;
            exerciseLoader.classList.remove('hidden');
            noExercisesMessage.classList.add('hidden');
            exerciseListContainer.innerHTML = '';
            paginationControls.innerHTML = '';
            let url = `${API_BASE_URL}/exercises?page=${currentExercisePage}`;
            if (currentMuscleGroupId !== 'all') {
                url += `&muscle_group_id=${currentMuscleGroupId}`;
            }
            if (currentSearchTerm) {
                url += `&search=${encodeURIComponent(currentSearchTerm)}`;
            }
            const response = await fetchData(url);
            exerciseLoader.classList.add('hidden');
            if (response && response.data && response.data.length > 0) {
                response.data.forEach(exercise => {
                    const card = document.createElement('div');
                    card.className = 'exercise-card bg-white p-3 sm:p-4 rounded-lg shadow-md hover:shadow-xl transition-all duration-200 ease-in-out flex flex-col justify-between';
                    const gifPlaceholder = `https://placehold.co/300x200/E2E8F0/4A5568?text=${encodeURIComponent(exercise.name_ru)}`;
                    const actualGifUrl = exercise.gif_filename ? `${GIF_BASE_URL}${exercise.gif_filename}` : gifPlaceholder;
                    card.innerHTML = `
                        <div>
                            <img src="${gifPlaceholder}" alt="${exercise.name_ru}" class="w-full h-32 sm:h-40 object-cover rounded-md mb-2 sm:mb-3" loading="lazy" onerror="this.onerror=null;this.src='https://placehold.co/300x200/E2E8F0/4A5568?text=Error';">
                            <h4 class="text-sm sm:text-base font-semibold text-gray-800 mb-1 leading-tight" title="${exercise.name_en || ''}">${exercise.name_ru}</h4>
                            <p class="text-xs text-indigo-500 font-medium mb-2">${exercise.main_muscle_group ? exercise.main_muscle_group.name_ru : 'Не указано'}</p>
                        </div>
                        <a href="${actualGifUrl}" target="_blank" class="mt-1 sm:mt-2 inline-block text-xs sm:text-sm text-indigo-600 hover:text-indigo-800 font-medium">Посмотреть GIF &rarr;</a>
                    `;
                    exerciseListContainer.appendChild(card);
                });
                renderPagination(response);
            } else {
                if(response) {
                    noExercisesMessage.textContent = 'Упражнения не найдены.';
                    noExercisesMessage.classList.remove('hidden');
                }
            }
        }

        // --- Pagination Rendering (остается без изменений) ---
        function renderPagination(paginationData) { /* ... */ }
        // (Код для renderPagination остается таким же)
        function renderPagination(paginationData) {
            if (!paginationControls || !paginationData || !paginationData.meta) {
                if(paginationControls) paginationControls.innerHTML = '';
                return;
            }
            paginationControls.innerHTML = '';
            const currentPage = paginationData.meta.current_page;
            const lastPage = paginationData.meta.last_page;
            if (lastPage <= 1) return;
            if (paginationData.links.prev) {
                const prevButton = document.createElement('button');
                prevButton.textContent = 'Назад';
                prevButton.className = 'px-3 py-1 text-sm font-medium text-gray-600 bg-white rounded-md shadow hover:bg-gray-50';
                prevButton.addEventListener('click', () => { currentExercisePage--; loadExercises(); });
                paginationControls.appendChild(prevButton);
            }
            paginationData.meta.links.forEach(link => {
                if (!link.url || link.label.includes('Previous') || link.label.includes('Next')) return;
                const pageButton = document.createElement('button');
                pageButton.innerHTML = link.label;
                pageButton.className = `px-3 py-1 text-sm font-medium rounded-md shadow ${link.active ? 'bg-indigo-600 text-white' : 'bg-white text-gray-600 hover:bg-gray-50'}`;
                if (link.active) pageButton.setAttribute('aria-current', 'page');
                pageButton.addEventListener('click', () => {
                    if (link.url) {
                        const urlParams = new URL(link.url).searchParams;
                        currentExercisePage = parseInt(urlParams.get('page')) || 1;
                        loadExercises();
                    }
                });
                paginationControls.appendChild(pageButton);
            });
            if (paginationData.links.next) {
                const nextButton = document.createElement('button');
                nextButton.textContent = 'Вперед';
                nextButton.className = 'px-3 py-1 text-sm font-medium text-gray-600 bg-white rounded-md shadow hover:bg-gray-50';
                nextButton.addEventListener('click', () => { currentExercisePage++; loadExercises(); });
                paginationControls.appendChild(nextButton);
            }
        }

        // --- Exercise Search (остается без изменений) ---
        let searchTimeout;
        if (exerciseSearchInput) { /* ... */ }
        // (Код для exerciseSearchInput остается таким же)
        if (exerciseSearchInput) {
            exerciseSearchInput.addEventListener('input', (e) => {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    currentSearchTerm = e.target.value.trim();
                    currentExercisePage = 1;
                    loadExercises();
                }, 500);
            });
        }


        // --- Page Navigation (Menu) Logic (остается без изменений) ---
        const pageViews = {
            'nav-diary': document.getElementById('current-workout-view'),
            'nav-workouts': document.getElementById('workouts-view'),
            'nav-exercises': document.getElementById('exercises-view'),
            'nav-programs': document.getElementById('programs-view'),
            'nav-measurements': document.getElementById('measurements-view'),
            'nav-statistics': document.getElementById('statistics-view'),
            'nav-settings': document.getElementById('settings-view')
        };
        function setActiveView(targetNavId) { /* ... */ }
        navLinks.forEach(link => { /* ... */ });
        // (Код для setActiveView и navLinks остается таким же)
        function setActiveView(targetNavId) {
            let viewToShowId = pageViews[targetNavId] ? pageViews[targetNavId].id : null;
            if (targetNavId === 'nav-diary' && pageViews['nav-diary']) {
                 viewToShowId = pageViews['nav-diary'].id;
            } else if (!viewToShowId && targetNavId === 'nav-exercises' && pageViews['nav-exercises']) {
                 viewToShowId = pageViews['nav-exercises'].id;
            } else if (!viewToShowId && !pageViews[targetNavId]) {
                 viewToShowId = 'exercises-view';
                 targetNavId = 'nav-exercises';
            }
            allPageDivs.forEach(div => {
                if (div && div.id === viewToShowId) div.classList.remove('hidden');
                else if (div) div.classList.add('hidden');
            });
            navLinks.forEach(link => {
                if (link.id === targetNavId) link.classList.add('menu-item-active');
                else link.classList.remove('menu-item-active');
            });
            if (window.innerWidth < 768 && sidebar && !sidebar.classList.contains('-translate-x-full')) {
                closeSidebar();
            }
            const pageContentDiv = document.getElementById('page-content');
            if(pageContentDiv) pageContentDiv.scrollTop = 0;

            if (targetNavId === 'nav-exercises') {
                if (exerciseFiltersContainer && exerciseFiltersContainer.children.length <= 1) {
                    loadMuscleGroups();
                }
                currentExercisePage = 1;
                currentMuscleGroupId = 'all';
                currentSearchTerm = '';
                if(exerciseSearchInput) exerciseSearchInput.value = '';
                document.querySelectorAll('#exercise-filters .filter-button').forEach(btn => btn.classList.remove('filter-button-active'));
                if(allFilterButton) allFilterButton.classList.add('filter-button-active');
                loadExercises();
            } else if (targetNavId === 'nav-diary') {
                const noWorkoutDiv = document.getElementById('no-active-workout');
                const activeWorkoutDiv = document.getElementById('active-workout-details');
                if (noWorkoutDiv) noWorkoutDiv.classList.remove('hidden');
                if (activeWorkoutDiv) activeWorkoutDiv.classList.add('hidden');
            }
        }
        navLinks.forEach(link => {
            link.addEventListener('click', (event) => {
                event.preventDefault();
                currentActiveNavId = link.id;
                setActiveView(currentActiveNavId);
            });
        });

        // --- CSV Import Logic ---
        if (importCsvFileInput && importCsvButton && importCsvStatusDiv && importCsvLoader && importCsvButtonText) {
            importCsvFileInput.addEventListener('change', (event) => {
                selectedCsvFile = event.target.files[0];
                if (selectedCsvFile) {
                    importCsvButton.disabled = false;
                    importCsvStatusDiv.textContent = `Выбран файл: ${selectedCsvFile.name} (${(selectedCsvFile.size / 1024).toFixed(2)} KB)`;
                    importCsvStatusDiv.className = 'mt-3 text-sm text-gray-600';
                } else {
                    importCsvButton.disabled = true;
                    importCsvStatusDiv.textContent = '';
                    selectedCsvFile = null;
                }
            });

            if (importCsvForm) {
                importCsvForm.addEventListener('submit', async (event) => {
                    event.preventDefault();
                    if (!selectedCsvFile) {
                        importCsvStatusDiv.textContent = 'Пожалуйста, выберите CSV файл для импорта.';
                        importCsvStatusDiv.className = 'mt-3 text-sm text-red-600';
                        return;
                    }

                    importCsvButtonText.classList.add('hidden');
                    importCsvLoader.classList.remove('hidden');
                    importCsvButton.disabled = true;
                    importCsvStatusDiv.textContent = 'Идет парсинг и подготовка данных...';
                    importCsvStatusDiv.className = 'mt-3 text-sm text-blue-600';

                    Papa.parse(selectedCsvFile, {
                        header: false, // Первая строка - это заголовки, но мы их обработаем кастомно
                        skipEmptyLines: true,
                        delimiter: ";",
                        complete: async function(results) {
                            const rawData = results.data;
                            console.log("Сырые данные из CSV:", rawData);
                            // TODO: Здесь будет логика преобразования rawData в JSON для отправки на API
                            // Этот JSON должен соответствовать структуре, которую ожидает ваш будущий API-эндпоинт
                            // Например:
                            // const processedDataForApi = processCsvData(rawData);
                            // console.log("Обработанные данные для API:", processedDataForApi);

                            // Пока что просто имитируем отправку
                            importCsvStatusDiv.textContent = `Файл ${selectedCsvFile.name} обработан. Имитация отправки на сервер...`;
                            
                            try {
                                // Имитация отправки на сервер и получение ответа
                                // Замените это на реальный fetch к вашему API:
                                // const response = await fetch(`${API_BASE_URL}/import/csv/workout-log`, {
                                //     method: 'POST',
                                //     headers: { 'Content-Type': 'application/json', /* 'Authorization': `Bearer ${your_auth_token}` */ },
                                //     body: JSON.stringify(processedDataForApi) 
                                // });
                                
                                await new Promise(resolve => setTimeout(resolve, 2000)); // Задержка для имитации
                                const mockSuccess = Math.random() > 0.3; // 70% шанс успеха для теста

                                if (mockSuccess) { // Замените на response.ok
                                    importCsvStatusDiv.textContent = 'Данные успешно импортированы (имитация)!';
                                    importCsvStatusDiv.className = 'mt-3 text-sm text-green-600';
                                    importCsvForm.reset(); 
                                    selectedCsvFile = null;
                                    importCsvButton.disabled = true;
                                } else {
                                    throw new Error('Сервер вернул ошибку при импорте (имитация).');
                                }
                            } catch (error) {
                                console.error('Ошибка импорта:', error);
                                importCsvStatusDiv.textContent = `Ошибка импорта: ${error.message}. Подробности в консоли.`;
                                importCsvStatusDiv.className = 'mt-3 text-sm text-red-600';
                            } finally {
                                importCsvButtonText.classList.remove('hidden');
                                importCsvLoader.classList.add('hidden');
                                // Кнопка останется disabled, пока не выбран новый файл (после reset формы)
                            }
                        },
                        error: function(error) {
                            console.error("Ошибка парсинга CSV:", error);
                            importCsvStatusDiv.textContent = `Ошибка парсинга CSV: ${error.message}`;
                            importCsvStatusDiv.className = 'mt-3 text-sm text-red-600';
                            importCsvButtonText.classList.remove('hidden');
                            importCsvLoader.classList.add('hidden');
                            importCsvButton.disabled = false; // Разрешаем повторную попытку, если файл не выбран
                        }
                    });
                });
            }
        }

        // --- Initial Load ---
        document.addEventListener('DOMContentLoaded', () => {
            setActiveView(currentActiveNavId);
        });

    </script>
</body>
</html>
```

**Ключевые изменения в JavaScript для импорта CSV:**
* **PapaParse:** Подключена библиотека PapaParse через CDN для удобного парсинга CSV-файлов.
* **Обработчик `importCsvForm`:**
    * Теперь использует `Papa.parse()` для разбора выбранного CSV-файла.
    * В коллбэке `complete` от PapaParse мы получаем `results.data` — это массив массивов, представляющий строки и ячейки CSV.
    * **`console.log("Сырые данные из CSV:", rawData);`**: Сейчас мы просто выводим эти сырые данные в консоль.
    * **`// TODO: Здесь будет логика преобразования rawData в JSON для отправки на API`**: Это место, где в будущем мы напишем функцию `processCsvData(rawData)`, которая преобразует массив из PapaParse в нужный нам JSON-формат, соответствующий структуре `WorkoutLog`, `LoggedExercise` и `LoggedSet`.
    * Остальная часть (имитация отправки, отображение статуса) осталась прежней, но теперь она будет вызываться после парсинга.

**Что делать дальше:**
1.  **Замените содержимое вашего файла `resources/views/app.blade.php`** на этот обновленный HTML-код.
2.  **Откройте сайт в браузере** (`http://gym.test/`), перейдите в "Настройки".
3.  **Выберите ваш CSV-файл** `diary_Кирилл1305_.csv`.
4.  **Нажмите "Импортировать CSV".**
5.  **Откройте консоль разработчика в браузере (обычно F12).** Вы должны увидеть там массив, выведенный `console.log("Сырые данные из CSV:", rawData);`. Это будут данные из вашего файла, разобранные PapaParse.

Когда вы увидите эти данные в консоли, пришлите мне их (или их часть, если они очень большие), и мы сможем вместе разработать функцию `processCsvData` для их преобразования в нужный JSON для отправки на наш будущий API-эндпои