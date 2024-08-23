@section('projectCards')
    <div class="modalCreateProject" id="modal_createProject">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Создать проект</h5>
                <button type="button" class="close" id="closeModalButton">&times;</button>
            </div>
            <div class="modal-body">
                <form id="createProjectForm" method="POST" action="{{ route('project.create') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="projectName" class="form-label">Название проекта</label>
                        <input type="text" class="form-control" id="projectName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="organization" class="form-label">Организация клиента</label>
                        <input type="text" class="form-control" id="organization" name="organization">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Телефон клиента</label>
                        <input type="text" class="form-control maskphone" id="phone" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Электронная почта клиента</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Создать проект</button>
                </form>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="body__filter__projects">
            <div class="body__filter__projects__container">


                <form id="searchForm" class="mt-3">
                    <div class="input-group">
                        <input type="text" class="form-control" id="searchInput" name="search"
                            placeholder="Поиск по проекту...">
                        <button type="button" id="searchButton" class="btn btn-secondary"> <img
                                src="./assets/img/icon/Search.svg" alt=""></button>
                    </div>
                </form>

                <div class="blocks__view">
                    <button id="blockViewBtn"><svg id="blockViewBtnSVG" width="19" height="15" viewBox="0 0 19 15"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="0.259766" y="0.21875" width="18.3906" height="2.39694" rx="1.19847" fill="#8E9397" />
                            <rect x="0.259766" y="6.21094" width="18.3906" height="2.39694" rx="1.19847" fill="#8E9397" />
                            <rect x="0.259766" y="12.2031" width="18.3906" height="2.39694" rx="1.19847" fill="#8E9397" />
                        </svg>
                    </button>
                    <button id="listViewBtn"><svg id="listViewBtnSVG"width="17" height="17" viewBox="0 0 17 17"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="0.96875" y="0.742188" width="6.6705" height="6.6705" rx="1" fill="#8E9397" />
                            <rect x="9.63281" y="0.742188" width="6.6705" height="6.6705" rx="1" fill="#8E9397" />
                            <rect x="0.96875" y="9.39844" width="6.6705" height="6.6705" rx="1" fill="#8E9397" />
                            <rect x="9.63281" y="9.39844" width="6.6705" height="6.6705" rx="1" fill="#8E9397" />
                        </svg>
                    </button>
                </div>


                <button type="button" class="btn btn-primary" id="openModalButton">
                    Создать проект
                </button>
            </div>




            <h1 class="project___h1">Проекты</h1>
        </div>


        <div class="projects__lists" style="display: flex;">
            @foreach ($projects as $project)
                    <div class="project-card">
                        <a href="{{ route('project.projectshow', ['id' => $project->id]) }}">
                        <div class="project-card__menu">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle"><svg width="23" height="5" viewBox="0 0 23 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="0.551758" y="0.382812" width="4" height="4" rx="2" fill="#8E9397"/>
                                    <rect x="9.55176" y="0.382812" width="4" height="4" rx="2" fill="#8E9397"/>
                                    <rect x="18.5518" y="0.382812" width="4" height="4" rx="2" fill="#8E9397"/>
                                    </svg>
                                    </a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('project.projectshow', ['id' => $project->id]) }}">подробнее</a></li>
                                    <li><a href="./fulldesign.php">Полный дизайн-проект</a></li>
                                  
                                    
                                </ul>
                            </li>
                        </div>
                        <div class="project-card__title">
                            <p><strong>Организация клиента:</strong> {{ $project->organization }}</p>
                            <h3>{{ $project->name }}</h3>
                        </div>
                        <div class="project-card__people">
                            <div class="project-card__people__block">
                                <p><strong>Команда:</strong> </p>
                            </div>
                            <div class="project-card__people__block">
                                <p><strong>Ответственный:</strong> </p>
                                <div class="user__lider__project">
                                    <img src="{{ $authenticatedUser->avatar ? asset($authenticatedUser->avatar) : asset('baseAdmin/stock/ava/avatar.png') }}"
                                    alt="Avatar" class="avatar-image">
                                    <p>{{$authenticatedUser->name}} {{$authenticatedUser->surname}}</p>
                                </div>
                              
                            </div>
                        </div>
                        <div class="project-card__info">
                            <p><strong>Сумма:</strong><span>228</span></p>
                     
                        </div>
                    </a>
                    </div>
              
            @endforeach
        </div>

        <div class="projects__block__lists" style="display: none;">
            @foreach ($projects as $project)
            <div class="project-block">
                <a href="{{ route('project.projectshow', ['id' => $project->id]) }}">
                    <div class="project-card__menu">
                        <ul class="dropdown">
                            <li>
                                <a href="#" class="dropdown-toggle" id="burger-toggle1">
                                    <svg width="23" height="5" viewBox="0 0 23 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect x="0.551758" y="0.382812" width="4" height="4" rx="2" fill="#8E9397"/>
                                        <rect x="9.55176" y="0.382812" width="4" height="4" rx="2" fill="#8E9397"/>
                                        <rect x="18.5518" y="0.382812" width="4" height="4" rx="2" fill="#8E9397"/>
                                    </svg>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('project.projectshow', ['id' => $project->id]) }}">Подробнее</a></li>
                                    <li><a href="./fulldesign.php">Полный дизайн-проект</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    
               
                <div class="project-card__title">
                  
                    <h3>{{ $project->name }}</h3>
                     <p><strong>Организация клиента:</strong> {{ $project->organization }}</p>
                </div>
                <div class="project-card__people">
                    <div class="project-card__people__block">
                        <p><strong>Команда:</strong> </p>
                    </div>
                  
                </div>
                <div class="project-card__people">
                  
                    <div class="project-card__people__block">
                        <p><strong>Ответственный:</strong> </p>
                        <div class="user__lider__project">
                            <img src="{{ $authenticatedUser->avatar ? asset($authenticatedUser->avatar) : asset('baseAdmin/stock/ava/avatar.png') }}"
                            alt="Avatar" class="avatar-image">
                            <p>{{$authenticatedUser->name}} {{$authenticatedUser->surname}}</p>
                        </div>
                    </div>
                </div>
                <div class="project-card__info">
               
              
                    <p><strong>Сумма:</strong> <span>228</span> </p>
                </div>
            </a>
            </div>
      
    @endforeach
        </div>

    </div>
@endsection
