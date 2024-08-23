@section('projectshowModal')
<div class="modalCreateProject" id="modal_createProject">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Создать задачу</h5>
            <button type="button" class="close" id="closeModalButton">&times;</button>
        </div>
        <div class="modal-body">
            <form id="createProjectForm" method="POST" action="{{ route('project.quest') }}">
                @csrf
                <input type="hidden" name="project_id" value="{{ $project->id }}">
                <div class="mb-3">
                    <label for="taskName" class="form-label">Название задачи</label>
                    <input type="text" class="form-control" id="taskName" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="taskDescription" class="form-label">Описание задачи</label>
                    <textarea class="form-control" id="taskDescription" name="description"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Создать задачу</button>
            </form>
        </div>
    </div>
</div>
@endsection
 