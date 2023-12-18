
<!--view modal-->
<div class="modal fade" id="viewTodoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Your todo list </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="modal-body">
          <div class="modal-body" px-4>
            <form action="" method="post" id="show-form-data">
              <div class="form-group">
                <label id="viewActivity"></label>
              </div>
              <div class="form-group">
                <label id="viewStatus"></label>
              </div>
              <div class="form-group">
                <label id="viewStart_date"></label>
              </div>
              <div class="form-group">
                <label id="viewEnd_date"> </label>
              </div>
              <div class="form-group">
                <label id="viewDescription"></label>
              </div>
              <div class="form-group">

              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
        <!--button type="button" class="btn btn-primary">Ok</button-->
      </div>
    </div>
  </div>
</div>

<!-- Edit modal  -->
<div class="modal fade" id="editTodoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update your Task</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="modal-body" px-4>
          <form action="editTodo.php" method="post" id="Edit-form-data">
            <input type="hidden" name="id" id="id" class="form-control" required>
            <div class="form-group">
              <input type="text" name="activity" class="form-control" id="editActivity" required>
            </div>
            <div class="form-group">
              <select class="form-control" id="editStatus" name="status">
                <option value="">--Select Status--</option>
                <option value="ongoing"> Ongoing </option>
                <option value="pending"> Pending</option>
                <option value="completed"> Completed</option>
                </select>
            </div>
            <div class="form-group">
              <input type="date" name="start_date" class="form-control" id="editStart_date" required>
            </div>
            <div class="form-group">
              <input type="date" name="end_date" class="form-control" id="editEnd_date" required>
            </div>
            <div class="form-group">
              <input type="text" name="description" class="form-control" id="editDescription" required>
            </div>
            <button type="submit" name="editTodoBtn" class="btn btn-primary" id="update">UPDATE</button>
          </form>
        </div>
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

      </div>
    </div>
  </div>
</div>


<!--Delete modal-->
<div class="modal fade" id="deleteTodoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title" style="text-align:center; color:red" id="exampleModalLabel">DELETE! </h1>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="modal-body">
          <div class="modal-body" px-4>
            <form action="editTodo.php" method="POST" id="show-form-data">
              <div class="form-group">
              <h3 style="text-align:center; color:red">Do you want to Delete the Record on row ?</h3>
                <input type="text" name="id" id="delTodoId" />
              </div>
              <button type="submit" name="deleteTodoBtn" class="btn btn-danger" id="delete">DELETE</button>
            </form>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
        </div>
    </div>
  </div>
</div>