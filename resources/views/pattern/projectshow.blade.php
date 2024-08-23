@section('projectshow')
    <div class="container">
        <div class="projectshow__body">
            <div class="projectshow__body__blocks">
                <div class="projectshow__body__logo">
                    <div class="user__lider__project">
                        <form id="avatarForm" action="{{ route('project.uploadAvatar', ['projectId' => $project->id]) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <label for="projectAvatarInput" class="avatar-label">
                                <img src="{{ $project->avatar ? asset($project->avatar) : asset('baseAdmin/stock/ava/avatar.png') }}"
                                    alt="Project Avatar" class="avatar-image">
                            </label>
                            <input type="file" name="avatar" id="projectAvatarInput" accept="image/*"
                                style="display:none;">
                        </form>
                    </div>
                </div>
                <div class="projectshow__body__name">
                    <p>{{ $project->organization }}</p>
                    <h1>{{ $project->name }}</h1>
                </div>
                <div class="projectshow__body__status">
                    <p>На проверке</p>
                </div>
                <div class="projectshow__body__status">
                    <a href="#" class="toggle-project-info">О проекте 
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8 0L10.1607 5.83927L16 8L10.1607 10.1607L8 16L5.83927 10.1607L0 8L5.83927 5.83927L8 0Z" fill="#8E9397"/>
                        </svg>
                    </a>
                </div>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle"><svg width="23" height="5" viewBox="0 0 23 5"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="0.551758" y="0.382812" width="4" height="4" rx="2" fill="#8E9397" />
                            <rect x="9.55176" y="0.382812" width="4" height="4" rx="2" fill="#8E9397" />
                            <rect x="18.5518" y="0.382812" width="4" height="4" rx="2" fill="#8E9397" />
                        </svg>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#" class="toggle-project-info">Подробнее
                           
                        </a></li>
                    </ul>
                </li>
            </div>
            <div class="projectshow__body__blocks">
                <div class="projectshow__progress">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M11.4237 18.768H12.4797C13.2797 18.768 13.9557 19.008 14.5077 19.488C15.0597 19.96 15.3357 20.616 15.3357 21.456C15.3357 22.296 15.0517 22.956 14.4837 23.436C13.9237 23.916 13.2277 24.156 12.3957 24.156C11.7157 24.156 11.1237 24 10.6197 23.688C10.1157 23.376 9.75569 22.932 9.53969 22.356L10.7277 21.672C10.9597 22.432 11.5157 22.812 12.3957 22.812C12.8677 22.812 13.2437 22.692 13.5237 22.452C13.8117 22.204 13.9557 21.872 13.9557 21.456C13.9557 21.048 13.8157 20.724 13.5357 20.484C13.2557 20.236 12.8837 20.112 12.4197 20.112H9.97169L10.2957 15.6H14.9757V16.896H11.5677L11.4237 18.768ZM21.7353 22.968C21.1593 23.76 20.3513 24.156 19.3113 24.156C18.2793 24.156 17.4673 23.76 16.8753 22.968C16.2993 22.176 16.0113 21.12 16.0113 19.8C16.0113 18.48 16.2993 17.424 16.8753 16.632C17.4673 15.84 18.2793 15.444 19.3113 15.444C20.3513 15.444 21.1593 15.84 21.7353 16.632C22.3193 17.416 22.6113 18.472 22.6113 19.8C22.6113 21.128 22.3193 22.184 21.7353 22.968ZM19.3113 22.812C19.9353 22.812 20.4113 22.552 20.7393 22.032C21.0673 21.512 21.2313 20.768 21.2313 19.8C21.2313 18.832 21.0673 18.088 20.7393 17.568C20.4113 17.048 19.9353 16.788 19.3113 16.788C18.6953 16.788 18.2193 17.048 17.8833 17.568C17.5553 18.088 17.3913 18.832 17.3913 19.8C17.3913 20.768 17.5553 21.512 17.8833 22.032C18.2193 22.552 18.6953 22.812 19.3113 22.812ZM26.8155 15.996C27.1915 16.372 27.3795 16.828 27.3795 17.364C27.3795 17.9 27.1915 18.356 26.8155 18.732C26.4475 19.1 25.9835 19.284 25.4235 19.284C24.8555 19.284 24.3875 19.1 24.0195 18.732C23.6435 18.356 23.4555 17.9 23.4555 17.364C23.4555 16.836 23.6435 16.384 24.0195 16.008C24.3955 15.632 24.8635 15.444 25.4235 15.444C25.9835 15.444 26.4475 15.628 26.8155 15.996ZM25.4115 18.228C25.6675 18.228 25.8755 18.148 26.0355 17.988C26.1955 17.82 26.2755 17.612 26.2755 17.364C26.2755 17.116 26.1955 16.908 26.0355 16.74C25.8755 16.572 25.6675 16.488 25.4115 16.488C25.1635 16.488 24.9595 16.572 24.7995 16.74C24.6395 16.908 24.5595 17.116 24.5595 17.364C24.5595 17.604 24.6395 17.808 24.7995 17.976C24.9675 18.144 25.1715 18.228 25.4115 18.228ZM24.8115 23.148L24.1635 22.764L29.6955 16.608L30.3435 16.98L24.8115 23.148ZM29.2635 24.144C28.6955 24.144 28.2275 23.96 27.8595 23.592C27.4835 23.216 27.2955 22.76 27.2955 22.224C27.2955 21.696 27.4835 21.244 27.8595 20.868C28.2355 20.492 28.7035 20.304 29.2635 20.304C29.8155 20.304 30.2795 20.492 30.6555 20.868C31.0315 21.244 31.2195 21.696 31.2195 22.224C31.2195 22.76 31.0315 23.216 30.6555 23.592C30.2875 23.96 29.8235 24.144 29.2635 24.144ZM29.2515 23.088C29.5075 23.088 29.7155 23.008 29.8755 22.848C30.0355 22.68 30.1155 22.472 30.1155 22.224C30.1155 21.976 30.0355 21.768 29.8755 21.6C29.7155 21.432 29.5075 21.348 29.2515 21.348C29.0035 21.348 28.7995 21.432 28.6395 21.6C28.4795 21.768 28.3995 21.976 28.3995 22.224C28.3995 22.464 28.4795 22.668 28.6395 22.836C28.8075 23.004 29.0115 23.088 29.2515 23.088Z"
                            fill="#292D32" />
                        <mask id="path-2-inside-1_231_45" fill="white">
                            <path
                                d="M40 20C40 31.0457 31.0457 40 20 40C8.95431 40 0 31.0457 0 20C0 8.95431 8.95431 0 20 0C31.0457 0 40 8.95431 40 20ZM4.1074 20C4.1074 28.7772 11.2228 35.8926 20 35.8926C28.7772 35.8926 35.8926 28.7772 35.8926 20C35.8926 11.2228 28.7772 4.1074 20 4.1074C11.2228 4.1074 4.1074 11.2228 4.1074 20Z" />
                        </mask>
                        <path
                            d="M40 20C40 31.0457 31.0457 40 20 40C8.95431 40 0 31.0457 0 20C0 8.95431 8.95431 0 20 0C31.0457 0 40 8.95431 40 20ZM4.1074 20C4.1074 28.7772 11.2228 35.8926 20 35.8926C28.7772 35.8926 35.8926 28.7772 35.8926 20C35.8926 11.2228 28.7772 4.1074 20 4.1074C11.2228 4.1074 4.1074 11.2228 4.1074 20Z"
                            stroke="#F3F4F8" stroke-width="32" mask="url(#path-2-inside-1_231_45)" />
                        <mask id="path-3-inside-2_231_45" fill="white">
                            <path
                                d="M20 40C17.3736 40 14.7728 39.4827 12.3463 38.4776C9.91982 37.4725 7.71504 35.9993 5.85786 34.1421C4.00069 32.285 2.5275 30.0802 1.52241 27.6537C0.517315 25.2272 0 22.6264 0 20C0 17.3736 0.517315 14.7728 1.52241 12.3463C2.5275 9.91982 4.00069 7.71504 5.85786 5.85786C7.71504 4.00069 9.91982 2.5275 12.3463 1.52241C14.7728 0.517315 17.3736 -1.14805e-07 20 0L20 4.1074C17.913 4.1074 15.8463 4.51847 13.9182 5.31715C11.99 6.11583 10.238 7.28647 8.76223 8.76223C7.28647 10.238 6.11583 11.99 5.31715 13.9182C4.51847 15.8463 4.1074 17.913 4.1074 20C4.1074 22.087 4.51847 24.1537 5.31715 26.0818C6.11583 28.01 7.28647 29.762 8.76223 31.2378C10.238 32.7135 11.99 33.8842 13.9182 34.6828C15.8463 35.4815 17.913 35.8926 20 35.8926L20 40Z" />
                        </mask>
                        <path
                            d="M20 40C17.3736 40 14.7728 39.4827 12.3463 38.4776C9.91982 37.4725 7.71504 35.9993 5.85786 34.1421C4.00069 32.285 2.5275 30.0802 1.52241 27.6537C0.517315 25.2272 0 22.6264 0 20C0 17.3736 0.517315 14.7728 1.52241 12.3463C2.5275 9.91982 4.00069 7.71504 5.85786 5.85786C7.71504 4.00069 9.91982 2.5275 12.3463 1.52241C14.7728 0.517315 17.3736 -1.14805e-07 20 0L20 4.1074C17.913 4.1074 15.8463 4.51847 13.9182 5.31715C11.99 6.11583 10.238 7.28647 8.76223 8.76223C7.28647 10.238 6.11583 11.99 5.31715 13.9182C4.51847 15.8463 4.1074 17.913 4.1074 20C4.1074 22.087 4.51847 24.1537 5.31715 26.0818C6.11583 28.01 7.28647 29.762 8.76223 31.2378C10.238 32.7135 11.99 33.8842 13.9182 34.6828C15.8463 35.4815 17.913 35.8926 20 35.8926L20 40Z"
                            stroke="#FFD445" stroke-width="32" mask="url(#path-3-inside-2_231_45)" />
                    </svg>
                </div>
                <p>Осталось</p>
                <span>Срок истек</span>

            </div>
            <div class="projectshow__body__blocks">
                <div class="projectshow__body__liders">
                    <div class="user__lider__project">
                        <img src="{{ $authenticatedUser->avatar ? asset($authenticatedUser->avatar) : asset('baseAdmin/stock/ava/avatar.png') }}"
                            alt="Avatar" class="avatar-image">
                        <div class="user__lider__project__namestatus">
                            <p>Ответственный</p>
                            <p>{{ $authenticatedUser->name }} {{ $authenticatedUser->surname }}</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="projectshow__body__allblocks">
            <div class="projectshow__body__allblock">
                <p>Последние изменения:</p>
                <div class="view__created">
                    <ul>
                        <li><a href="">Лила Поступова</a><a href="">Лила Поступова</a><a href="">Лила
                                Поступова</a><a href="">Лила Поступова</a><a href="">Лила Поступова</a></li>
                        <li><a href="">Лила Поступова</a><a href="">Лила Поступова</a><a href="">Лила
                                Поступова</a><a href="">Лила Поступова</a><a href="">Лила Поступова</a></li>
                        <li><a href="">Лила Поступова</a><a href="">Лила Поступова</a><a href="">Лила
                                Поступова</a><a href="">Лила Поступова</a><a href="">Лила Поступова</a></li>
                    </ul>
                </div>
            </div>
            <div class="projectshow__body__allblock">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle"><svg width="23" height="5" viewBox="0 0 23 5"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="0.551758" y="0.382812" width="4" height="4" rx="2" fill="#8E9397" />
                            <rect x="9.55176" y="0.382812" width="4" height="4" rx="2" fill="#8E9397" />
                            <rect x="18.5518" y="0.382812" width="4" height="4" rx="2" fill="#8E9397" />
                        </svg>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('project.projectshow', ['id' => $project->id]) }}">подробнее</a></li>
                        <li><a href="./fulldesign.php">Полный дизайн-проект</a></li>


                    </ul>
                </li>
                <p>Над проектом работают:</p>
                <div class="users__created">
                    <div class="users__created_block">
                        <div class="users__created__ava">
                            <img src="" alt="">
                        </div>
                        <div class="users__created__info">
                            <p>Ответсвенный</p>
                            <h6>Иван Иванов</h6>
                        </div>

                    </div>
                    <div class="users__created_block">
                        <div class="users__created__ava">
                            <img src="" alt="">
                        </div>
                        <div class="users__created__info">
                            <p>Ответсвенный</p>
                            <h6>Иван Иванов</h6>
                        </div>

                    </div>
                    <div class="users__created_block">
                        <div class="users__created__ava">
                            <img src="" alt="">
                        </div>
                        <div class="users__created__info">
                            <p>Ответсвенный</p>
                            <h6>Иван Иванов</h6>
                        </div>

                    </div>
                    <div class="users__created_block">
                        <div class="users__created__ava">
                            <img src="" alt="">
                        </div>
                        <div class="users__created__info">
                            <p>Ответсвенный</p>
                            <h6>Иван Иванов</h6>
                        </div>

                    </div>
                    <div class="users__created_block">
                        <div class="users__created__ava">
                            <img src="" alt="">
                        </div>
                        <div class="users__created__info">
                            <p>Ответсвенный</p>
                            <h6>Иван Иванов</h6>
                        </div>

                    </div>
                </div>
            </div>
            <div class="projectshow__body__allblock">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle"><svg width="23" height="5" viewBox="0 0 23 5"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="0.551758" y="0.382812" width="4" height="4" rx="2" fill="#8E9397" />
                            <rect x="9.55176" y="0.382812" width="4" height="4" rx="2" fill="#8E9397" />
                            <rect x="18.5518" y="0.382812" width="4" height="4" rx="2" fill="#8E9397" />
                        </svg>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('project.projectshow', ['id' => $project->id]) }}">подробнее</a></li>
                        <li><a href="./fulldesign.php">Полный дизайн-проект</a></li>
                    </ul>
                </li>
                <p>Файлы:</p>
                <div class="files__project">
                    <ul>
                        <li>
                            <div class="block__ava_file">
                                <img src="" alt="">
                            </div>
                            <div class="block__ava_info">
                                <p>Документ</p>
                                <h6>Название документа</h6>
                            </div>
                        </li>
                        <li>
                            <div class="block__ava_file">
                                <img src="" alt="">
                            </div>
                            <div class="block__ava_info">
                                <p>Документ</p>
                                <h6>Название документа</h6>
                            </div>
                        </li>
                        <li>
                            <div class="block__ava_file">
                                <img src="" alt="">
                            </div>
                            <div class="block__ava_info">
                                <p>Документ</p>
                                <h6>Название документа</h6>
                            </div>
                        </li>
                        <li>
                            <div class="block__ava_file">
                                <img src="" alt="">
                            </div>
                            <div class="block__ava_info">
                                <p>Документ</p>
                                <h6>Название документа</h6>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="projectshow__body">
                <div class="body__filter__projects__container">
                    <form id="searchForm" class="mt-3">
                        <div class="input-group">
                            <input type="text" class="form-control" id="searchInput" name="search"
                                placeholder="Поиск по задачам...">
                            <button type="button" id="searchButton" class="btn btn-secondary"> <img
                                    src="./assets/img/icon/Search.svg" alt=""></button>
                        </div>
                    </form>
                    <div class="blocks__view">
                        <button id="blockViewBtn"><svg id="blockViewBtnSVG" width="19" height="15"
                                viewBox="0 0 19 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="0.259766" y="0.21875" width="18.3906" height="2.39694" rx="1.19847"
                                    fill="#8E9397" />
                                <rect x="0.259766" y="6.21094" width="18.3906" height="2.39694" rx="1.19847"
                                    fill="#8E9397" />
                                <rect x="0.259766" y="12.2031" width="18.3906" height="2.39694" rx="1.19847"
                                    fill="#8E9397" />
                            </svg>
                        </button>
                        <button id="listViewBtn"><svg id="listViewBtnSVG"width="17" height="17" viewBox="0 0 17 17"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="0.96875" y="0.742188" width="6.6705" height="6.6705" rx="1"
                                    fill="#8E9397" />
                                <rect x="9.63281" y="0.742188" width="6.6705" height="6.6705" rx="1"
                                    fill="#8E9397" />
                                <rect x="0.96875" y="9.39844" width="6.6705" height="6.6705" rx="1"
                                    fill="#8E9397" />
                                <rect x="9.63281" y="9.39844" width="6.6705" height="6.6705" rx="1"
                                    fill="#8E9397" />
                            </svg>
                        </button>
                    </div>
                    <button type="button" class="btn btn-primary" id="openModalButton">
                        Создать задачу
                    </button>
                    <form id="addStatusForm" method="POST" action="{{ route('projects.addStatus') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="statusName" class="form-label">Название статуса</label>
                            <input type="text" class="form-control" id="statusName" name="status_name" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Добавить статус</button>
                    </form>
                </div>
            </div>
        </div>
        <div id="kanbanBoard" class="kanban-board">
            @foreach ($statuses as $status)
                <div class="kanban-column" draggable="true" id="{{ $status }}">
                    <h2>{{ ucfirst($status) }}</h2>
                    <div class="kanban-tasks" data-column="{{ $status }}">
                        @foreach ($tasks->where('status', $status) as $task)
                            <div class="kanban-task" draggable="true" data-task-id="{{ $task->id }}">
                                <h5>{{ $task->name }}</h5>
                                <p>{{ $task->description }}</p>
                                <select class="status-select" data-task-id="{{ $task->id }}">
                                    @foreach ($statuses as $option)
                                        <option value="{{ $option }}"
                                            {{ $task->status === $option ? 'selected' : '' }}>
                                            {{ ucfirst($option) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endforeach
                    </div>
                </div>  
            @endforeach
        </div>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script src="{{ secure_asset('assets/js/projectshow/toggle-project-info.js') }}"></script>
        <script src="{{ secure_asset('assets/js/projectshow/projectAvatarInput.js') }}"></script>


        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const kanbanBoard = document.getElementById('kanbanBoard');
                let statuses = [];
            
                const createKanbanColumn = (status) => {
                    const column = document.createElement('div');
                    column.classList.add('kanban-column');
                    column.dataset.column = status;
                    column.setAttribute('draggable', 'true');
                    column.innerHTML = `
            <h2>${status.charAt(0).toUpperCase() + status.slice(1)}</h2>
            <div class="kanban-tasks" data-column="${status}">
                <!-- Tasks will be added here -->
            </div>
            `;
                    kanbanBoard.appendChild(column);
            
                    column.addEventListener('dragover', (e) => {
                        e.preventDefault();
                        column.classList.add('dragover');
                    });
            
                    column.addEventListener('dragleave', (e) => {
                        column.classList.remove('dragover');
                    });
            
                    column.addEventListener('drop', (e) => {
                        e.preventDefault();
                        column.classList.remove('dragover');
                        const taskId = e.dataTransfer.getData('text/plain');
                        const task = document.querySelector(`.kanban-task[data-task-id="${taskId}"]`);
                        const newStatus = column.dataset.column;
                        const oldStatus = task.dataset.column;
            
                        updateTaskStatus(taskId, newStatus).then(response => {
                            column.querySelector('.kanban-tasks').appendChild(task);
            
                            // Обновляем выпадающий список статусов
                            const statusSelect = task.querySelector('.status-select');
                            statusSelect.value = newStatus;
            
                            // Обновляем data-column у задачи
                            task.dataset.column = newStatus;
                        }).catch(error => {
                            console.error('Error updating task status:', error);
                        });
                    });
            
                    column.addEventListener('dragstart', (e) => {
                        e.dataTransfer.setData('column', column.dataset.column);
                        column.classList.add('dragging-column');
                    });
            
                    column.addEventListener('dragend', (e) => {
                        column.classList.remove('dragging-column');
                    });
                };
            
            
                const loadStatuses = () => {
                    axios.get('{{ route('getStatuses') }}')
                        .then(response => {
                            statuses = response.data;
                            kanbanBoard.innerHTML = ''; // Очищаем доску перед добавлением колонок
                            statuses.forEach(status => {
                                createKanbanColumn(status);
                            });
                            loadTasks(); // Загружаем задачи после создания колонок
                        })
                        .catch(error => {
                            console.error('Error fetching statuses:', error);
                        });
                };
            
                const loadTasks = () => {
                    axios.get('{{ route('getTasks', ['project_id' => $project->id]) }}')
                        .then(response => {
                            const tasks = response.data;
                            tasks.forEach(task => {
                                const column = document.querySelector(
                                    `.kanban-tasks[data-column="${task.status}"]`);
                                if (column) {
                                    const taskElement = createTaskElement(task);
                                    column.appendChild(taskElement);
                                }
                            });
                            initializeTaskDragAndDrop();
                            initializeStatusSelects();
                        })
                        .catch(error => {
                            console.error('Error fetching tasks:', error);
                        });
                };
            
                const createTaskElement = (task) => {
                    const taskElement = document.createElement('div');
                    taskElement.classList.add('kanban-task');
                    taskElement.setAttribute('draggable', 'true');
                    taskElement.dataset.taskId = task.id;
                    taskElement.dataset.column = task.status;
                    taskElement.innerHTML = `
            <h5>${task.name}</h5>
            <p>${task.description}</p>
            <select class="status-select" data-task-id="${task.id}">
                ${statuses.map(status => `
                                                            <option value="${status}" ${task.status === status ? 'selected' : ''}>
                                                                ${status.charAt(0).toUpperCase() + status.slice(1)}
                                                            </option>
                                                        `).join('')}
            </select>
            `;
                    return taskElement;
                };
            
                const initializeTaskDragAndDrop = () => {
                    document.querySelectorAll('.kanban-task').forEach(task => {
                        task.addEventListener('dragstart', (e) => {
                            e.dataTransfer.setData('text/plain', task.dataset.taskId);
                            task.classList.add('dragging');
                        });
            
                        task.addEventListener('dragend', (e) => {
                            task.classList.remove('dragging');
                        });
                    });
                };
            
                const initializeStatusSelects = () => {
                    document.querySelectorAll('.status-select').forEach(select => {
                        select.addEventListener('change', (e) => {
                            const taskId = e.target.dataset.taskId;
                            const newStatus = e.target.value;
                            const task = e.target.closest('.kanban-task');
                            const oldStatus = task.dataset.column;
            
                            updateTaskStatus(taskId, newStatus).then(response => {
                                const oldColumn = document.querySelector(
                                    `.kanban-tasks[data-column="${oldStatus}"]`);
                                const newColumn = document.querySelector(
                                    `.kanban-tasks[data-column="${newStatus}"]`);
            
                                if (oldColumn && newColumn) {
                                    oldColumn.removeChild(task);
                                    newColumn.appendChild(task);
                                    task.dataset.column = newStatus;
                                }
                            }).catch(error => {
                                console.error('Error updating task status:', error);
                                // Возвращаем старое значение в случае ошибки
                                e.target.value = oldStatus;
                            });
                        });
                    });
                };
            
                const updateTaskStatus = (taskId, newStatus) => {
                    return axios.post('{{ route('updateTaskStatus') }}', {
                        task_id: taskId,
                        status: newStatus
                    }).then(response => {
                        // Обновляем интерфейс после успешного обновления на сервере
                        const task = document.querySelector(`.kanban-task[data-task-id="${taskId}"]`);
                        const oldStatus = task.dataset.column;
                        const oldColumn = document.querySelector(
                            `.kanban-tasks[data-column="${oldStatus}"]`);
                        const newColumn = document.querySelector(
                            `.kanban-tasks[data-column="${newStatus}"]`);
            
                        if (oldColumn && newColumn) {
                            oldColumn.removeChild(task);
                            newColumn.appendChild(task);
                            task.dataset.column = newStatus;
                            task.querySelector('.status-select').value = newStatus;
                        }
            
                        return response;
                    });
                };
            
                // Обработчик формы добавления нового статуса
                document.getElementById('addStatusForm').addEventListener('submit', (e) => {
                    e.preventDefault();
            
                    const formData = new FormData(e.target);
            
                    axios.post('{{ route('projects.addStatus') }}', formData)
                        .then(response => {
                            const statusName = formData.get('status_name');
                            createKanbanColumn(statusName);
                            statuses.push(statusName);
                            e.target.reset();
            
                            // Обновляем выпадающие списки статусов у всех задач
                            document.querySelectorAll('.status-select').forEach(select => {
                                const option = document.createElement('option');
                                option.value = statusName;
                                option.textContent = statusName.charAt(0).toUpperCase() + statusName
                                    .slice(1);
                                select.appendChild(option);
                            });
                        })
                        .catch(error => {
                            console.error('Error adding status:', error);
                        });
                });
            
                // Загружаем статусы и задачи при загрузке страницы
                loadStatuses();
            });</script>
    
    @endsection
