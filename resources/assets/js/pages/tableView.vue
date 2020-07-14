<template>
  <div  class="white-box" >
    <mytabs card
    @setting-click="settingClick"
    @group-by="groupby"
    >
      <subtask-modal
        v-show="isSubTaskModalVisible"
        :taskData = "addSubTaskParam"
        @close="closeSubTaskAdd"
        @save="saveSubTaskAdd"
      />
      
      <assignee-modal
        v-show="isAssignModalVisible"
        :employees = "this.all_employeess"
        :taskData = "addSubTaskParam"
        @close="closeAssigneeAdd"
        @save="saveAssigneeAdd"
      />

      <project-modal
        v-show="isProjectModalVisible"
        :projects = "this.all_projects"
        :taskData = "addSubTaskParam"
        @close="closeProjectsAdd"
        @save="saveProjectsAdd"
      />
    
      <mytab :name="'Tasks('+ all_length +')'" selected="true">
        <custom-table :headers="headers" :employees="all_employeess" :datas="all_datas" :taskCat="taskCat" :proCat="proCat" :clients="clients" :hide_completed = "hide_completed"
        @add-new="addNew"
        @row-single-action="rowSingleAction"
        @row-multiple-action="rowMultipleAction"
        @add-new-input="addNewInput"
        @on-column-filter="onColumnFilter"
        @on-complete-edit="updateTask"
        @on-move="onMove"
        @recurr-dialog="recurrDialog"></custom-table>
      </mytab>
      <mytab :name="'My Task('+ my_length +')'">
        <custom-table :headers="headers" :employees="all_employeess" :taskCat="taskCat" :proCat="proCat" :clients="clients" :datas="my_datas" :hide_completed = "hide_completed"
        @add-new="addNew"
        @row-single-action="rowSingleAction"
        @row-multiple-action="rowMultipleAction"
        @add-new-input="addNewInput"
        @on-complete-edit="updateTask"
        @on-move="onMove"
        @recurr-dialog="recurrDialog"></custom-table>
      </mytab>
      
      <mytab :name="'TeamTasks('+ team_length +')'">
        <custom-table :headers="headers" :employees="all_employeess" :taskCat="taskCat" :proCat="proCat" :clients="clients" :datas="team_datas" :hide_completed = "hide_completed"
        @add-new="addNew"
        @row-single-action="rowSingleAction"
        @row-multiple-action="rowMultipleAction"
        @on-complete-edit="updateTask"
        @add-new-input="addNewInput"
        @on-move="onMove"
        @recurr-dialog="recurrDialog"></custom-table>
      </mytab>
      <mytab :name="'Due today('+ today_length +')'">
        <custom-table :headers="headers" :employees="all_employeess" :taskCat="taskCat" :proCat="proCat" :clients="clients" :datas="today_datas" :hide_completed = "hide_completed"
        @add-new="addNew"
        @row-single-action="rowSingleAction"
        @row-multiple-action="rowMultipleAction"
        @on-complete-edit="updateTask"
        @add-new-input="addNewInput"
        @on-move="onMove"
        @recurr-dialog="recurrDialog"></custom-table>
      </mytab>
      <mytab :name="'Due Tomorrow('+ tomorrow_length +')'">
        <custom-table :headers="headers" :employees="all_employeess" :taskCat="taskCat" :proCat="proCat" :clients="clients" :datas="tomorrow_datas" :hide_completed = "hide_completed"
        @add-new="addNew"
        @row-single-action="rowSingleAction"
        @row-multiple-action="rowMultipleAction"
        @on-complete-edit="updateTask"
        @add-new-input="addNewInput"
        @on-move="onMove"
        @recurr-dialog="recurrDialog"></custom-table>
      </mytab>
      <mytab :name="'Overdue('+ overdue_length +')'">
        <custom-table :headers="headers" :employees="all_employeess" :taskCat="taskCat" :proCat="proCat" :clients="clients" :datas="overdue_datas" :hide_completed = "hide_completed"
        @add-new="addNew"
        @row-single-action="rowSingleAction"
        @on-complete-edit="updateTask"
        @row-multiple-action="rowMultipleAction"
        @add-new-input="addNewInput"
        @on-move="onMove"
        @recurr-dialog="recurrDialog"></custom-table>
      </mytab>
    </mytabs>


    <!--
    <div style="display:flex;align-items:center; position: absolute; top:140px; right: 10px;margin-top:25px;margin-right:50px;">
      <dropdown icon="./img/groupby.png" @on-click="groupby" :items="['GroupBY']" right="right:10px"></dropdown>

      <dropdown
        icon="./img/setting.png"
        @on-click="setting"
        right="right:10px"
        :items="['Hide completed task', 'Hide/Show Columns','Add new Column (Admin Only)','Rearrange column order','Export to Excel']"
      ></dropdown>
    </div> -->
    
    <RecurrDialog v-if="is_recurr"
    @save="recurr_save"
    @cancel="recurr_cancel">
    </RecurrDialog>
  </div> 
</template>
<script>
import dropdown from "../components/Dropdown";
import CustomTable from "../components/CustomTable";
import mytabs from "../components/tabs";
import mytab from "../components/tab";
import SubtaskModal from "../components/addSubtaskModal";
import AssigneeModal from "../components/addAssigneeModal";
import ProjectModal from "../components/moveToProjectModal";
import RecurrDialog from "../components/recurring/RecurrDialog";
import moment from "moment";

export default {
  name: "TableView",
  components: {
    CustomTable,
    dropdown,
    mytabs,
    mytab,
    SubtaskModal,
    AssigneeModal,
    ProjectModal,
    RecurrDialog
  },
  methods: {
    recurrDialog(param) {
      //do parse parameters to dialog before showing.
      console.log('test');
      this.is_recurr = true;
    },
    recurr_save(param) {
      alert('saved successfully');
      this.is_recurr = false;
    },
    recurr_cancel() {
      this.is_recurr = false;
    },
    addNew(param) {
      window.location.href = this.routes.newTask;
    },
    addNewInput(param) {
      //function for inputting new_task in the below of the group.
      // param.name : name inputted in the textbox.
      // param.index : group index, same as parent_index in the below function.
      // alert('input');
      console.log('addnewinput',param);
      var title = param.title;
      var index = param.index;
      var task = {
        "id": 0,
        "ID": 0,
        "group_id": 1,
        "Task": "",
        "project": "",
        "Client": null,
        "Assignee": "",
        "image": null,
        "Assigner": "",
        "created_image": "",
        "DueDate": "",
        "EstHours": 0,
        "ActualHours": 0,
        "sectionTitles": "",
        "tags": "",
        "Priority": "",
        "StartDate": "",
        "EndDate": null,
        "CreatedDate": "",
        "TaskCat": "",
        "ProjectCat": "",
        "column_name": "",
        "label_color": "",
        "project_id": 1,
        "Status": "incomplete",
        "user_id": 8,
        "created_by": 7,
        "board_column_id": 5,
        "sub_tasks": [],
        "showSubtasks": true,
        "vgtSelected": false,
        "due_on": "",
        "create_on": "",
        "editable": false,
        "vgt_id": 0,
        "originalIndex": 1
      };
      task.Task = title;
      task.project = this.all_datas[index].label;
      task.created_by = this.currentUser.id;
      task.created_image = this.currentUser.image;
      task.CreatedDate = this.getCurrentDate();

      if(title[0] == ' '){ //subtask
        var length =  this.all_datas[index].children.length;
        task.ProjectCat  = this.all_datas[index].children[length-1].ProjectCat;
        task.DueDate  = this.all_datas[index].children[length-1].DueDate;
        
        this.all_datas[index].children[length-1].sub_tasks.push(task);
      }
      else{ //task
        this.all_datas[index].children.push(task);
        console.log(task);
      }
      // window.location.href = this.routes.newTask;
    },
    onColumnFilter(param) {
      //This function called when the filter changed (maybe two times, one for filterRows & one for columnfilters)
      //filteredRows contains the filtered datas
      //columnfilters contains the filter list in the header
      if(param.filteredRows){
        console.log('get filteredrows');
        this.filteredRows = param.filteredRows;
      }
      if(param.columnFilters){
        console.log('column filters');
        this.columnFilters = param.columnFilters;
        console.log(param);
      }

    },
    getCurrentDate:function(){
      return moment().format('YYYY-MM-DD');
    },
    onMove(params){
      console.log('move :  ', params);
      // this.updateSubDatas();
    },
    updateTask(param){
      console.log('complete edit',param);
      // var url = this.routes.updateTask;
      // this.axios.post(url,{task:param}).then(response => {
      // });
    },
    rowSingleAction(param) {
      //function for dropdown action for individual row.
      // param.item : action string
      // param.row : selected data
      // param.index : selected index in group
      // param.parent_index : group index
      if(param.item == 'Add Subtask'){
        this.addSubTaskParam = param;
        this.showSubTaskModal();
      }
      if(param.item == 'Assign'){
        this.addSubTaskParam = param;
        this.showAssigneeModal();
      }
      if(param.item == 'Pickup (assign myself)'){
        alert('Pickup (assign myself) for ' + param.parent_index + '/' + param.index);
      }
      if(param.item == 'Mark Complete'){
      
        // console.log("mark complete : " , param);

        this.all_datas[param.parent_index].children[param.index].Status = 'completed';
        var url = this.routes.updateTask;
        this.axios.post(url,{task:this.all_datas[param.parent_index].children[param.index]}).then(response => {
        });
      }
      if(param.item == 'Duplicate'){
        // alert('Duplicate for ' + param.parent_index + '/' + param.index);
        // var dupOne = this.all_datas[param.parent_index].children[param.index];
        // this.all_datas[param.parent_index].children.splice(param.index, 0, dupOne);
        
        var url = this.routes.duplicateTask;
        this.all_datas.forEach((headerRow, parent_index) => {
            var dupOne = [];
            var pos = 0;
            headerRow.children.forEach((row, index) => {
              if(param.row.ID == row.ID) {
                dupOne = this.all_datas[parent_index].children[index];
                pos = index;
                console.log(this.token);
                this.axios.post(url,{id:row.ID}).then(response => {
                });
              }
            });
            this.updateSubDatas();
            this.all_datas[parent_index].children.splice(pos, 0, dupOne);
          });

      }
      if(param.item == 'Move to Project'){
        this.addSubTaskParam = param;
        this.showProjectsModal();
        // this.all_datas[param.parent_index].children[param.index].Status = 'completed';
        // var url = this.routes.updateTask;
        // this.axios.post(url,{task:this.all_datas[param.parent_index].children[param.index]}).then(response => {
        // });
        // alert('Move to Project for ' + param.parent_index + '/' + param.index);
      }
      if(param.item == 'Edit'){
      }
      if(param.item == 'Copy to Project'){
        alert('Copy to Project for ' + param.parent_index + '/' + param.index);
      }
      if(param.item == 'Delete'){
        // alert('Delete for ' + param.parent_index + '/' + param.index);

        // console.log(this.pro_datas[param.parent_index].children[param.index].id);
        var id = this.all_datas[param.parent_index].children[param.index].id;
        this.all_datas.forEach((headerRow, parent_index) => {
          headerRow.children.forEach((row, index) => {
            if(param.row.ID == row.ID){
              this.updateSubDatas();
              this.all_datas[parent_index].children.splice(index, 1);
            }
          });
        });

        var url = this.routes.deleteTask;
        url = url.replace(':id',id);

        this.axios.post(url,{'_token': this.token, '_method': 'DELETE'}).then(response => {
        });

      }
    },
    rowMultipleAction(param) {
      // function for dropdown action for multiple in the top
      // param.item : action string
      // param.selectedPageRows :selected data list
      console.log(param);
      if(param.item == 'Assign'){
        this.addSubTaskParam = param.selectedPageRows;
        this.showAssigneeModal();
      }
      if(param.item == 'Pickup (assign myself)'){
        alert('Pickup (assign myself) selected');
      }
      if(param.item == 'Mark Complete'){
        param.selectedPageRows.forEach((selected, sel_index) => {
          this.all_datas.forEach((headerRow, parent_index) => {
            headerRow.children.forEach((row, index) => {
              if(selected.ID == row.ID){
                this.all_datas[parent_index].children[index].Status = 'completed';
                var url = this.routes.updateTask;
                this.axios.post(url,{task:this.all_datas[parent_index].children[index]}).then(response => {
                });
              } 
            });
          });
        });
      }
      if(param.item == 'Duplicate'){
        // alert('Duplicate selected');
        var url = this.routes.duplicateTask;
        param.selectedPageRows.forEach((selected, sel_index) => {
          this.all_datas.forEach((headerRow, parent_index) => {
            var dupOne = [];
            var pos = 0;
            headerRow.children.forEach((row, index) => {
              if(selected.ID == row.ID) {
                dupOne = this.all_datas[parent_index].children[index];
                pos = index;
                this.axios.post(url,{id:row.ID}).then(response => {
                });
              }
            });
            this.updateSubDatas();
            this.all_datas[parent_index].children.splice(pos, 0, dupOne);

          });
        });
      }
      if(param.item == 'Move to Project'){
        alert('Move to Project selected');
      }
      if(param.item == 'Copy to Project'){
        alert('Copy to Project selected');
      }
      if(param.item == 'Delete'){
        // alert('Delete selected');
        var url = this.routes.deleteTask;

        param.selectedPageRows.forEach((selected, sel_index) => {
          this.all_datas.forEach((headerRow, parent_index) => {
            headerRow.children.forEach((row, index) => {
              if(selected.ID == row.ID){
                
                var url = this.routes.deleteTask;
                url = url.replace(':id',row.ID);
                this.axios.post(url,{'_token': this.token, '_method': 'DELETE'}).then(response => {
                });
                this.all_datas[parent_index].children.splice(index, 1);
                this.updateSubDatas();
              }
            });
          });
        });


      }
    },
    search() {

    },
    settingClick(param) {
      if(param.item == 'Hide completed task'){
        this.hide_completed = !this.hide_completed;
        this.$forceUpdate();
      }
      if(param.item == 'Hide/Show  Columns'){
        alert('Setting / Hide/Show  Columns');
      }
      if(param.item == 'Add new Column (Admin Only)'){
        alert('Setting / Add new Column (Admin Only)');
      }
      if(param.item == 'Rearrange column order'){
        alert('Setting / Rearrange column order');
      }
      if(param.item == 'Export to Excel'){
        console.log("export Excel",this.all_datas);
        var url = this.routes.exportExcel;
        var uri = 'all-tasks/export/2019-08-20/2019-09-19/all/0';
        // url = url.replace(':startDate', null);
        // url = url.replace(':endDate', null);
        // url = url.replace(':hideCompleted', 0);
        // url = url.replace(':projectId', 0);
        this.axios.post(url,{data:this.all_datas}).then(response => {
        });
      }
    },
    groupby() {
      alert('groupby clicked')
    },
    updateSubDatas() {
      console.log('update subdatas');
      this.all_length = 0;
      this.my_length = 0;
      this.team_length = 0;
      this.today_length = 0;
      this.tomorrow_length = 0;
      this.overdue_length = 0;

      this.my_datas = [];
      this.team_datas = [];
      this.today_datas = [];
      this.tomorrow_datas = [];
      this.overdue_datas = [];

      this.all_datas.forEach((headerRow, parent_index) => {
        this.all_length += headerRow.children.length;
        this.my_datas[parent_index] = {};
        this.my_datas[parent_index]['group_id'] = headerRow.group_id;
        this.my_datas[parent_index]['html'] = headerRow.html;
        this.my_datas[parent_index]['label'] = headerRow.label;
        this.my_datas[parent_index]['mode'] = headerRow.mode;

        this.team_datas[parent_index] = {};
        this.team_datas[parent_index]['group_id'] = headerRow.group_id;
        this.team_datas[parent_index]['html'] = headerRow.html;
        this.team_datas[parent_index]['label'] = headerRow.label;
        this.team_datas[parent_index]['mode'] = headerRow.mode;

        this.today_datas[parent_index] = {};
        this.today_datas[parent_index]['group_id'] = headerRow.group_id;
        this.today_datas[parent_index]['html'] = headerRow.html;
        this.today_datas[parent_index]['label'] = headerRow.label;
        this.today_datas[parent_index]['mode'] = headerRow.mode;

        this.tomorrow_datas[parent_index] = {};
        this.tomorrow_datas[parent_index]['group_id'] = headerRow.group_id;
        this.tomorrow_datas[parent_index]['html'] = headerRow.html;
        this.tomorrow_datas[parent_index]['label'] = headerRow.label;
        this.tomorrow_datas[parent_index]['mode'] = headerRow.mode;

        this.overdue_datas[parent_index] = {};
        this.overdue_datas[parent_index]['group_id'] = headerRow.group_id;
        this.overdue_datas[parent_index]['html'] = headerRow.html;
        this.overdue_datas[parent_index]['label'] = headerRow.label;
        this.overdue_datas[parent_index]['mode'] = headerRow.mode;

        var my_tasks = [];
        var team_tasks = [];
        var today_tasks = [];
        var tomorrow_tasks = [];
        var overdue_tasks = [];

        headerRow.children.forEach((row, index) => {
          // debugger;
          this.all_datas[parent_index].children[index].project = this.all_datas[parent_index].label;
          console.log(this.all_datas[parent_index].children[index].project);
          console.log(moment(this.all_datas[parent_index].children[index].DueDate, 'YYYY-MM-DD').fromNow());
          //Update my_data
          if(this.all_datas[parent_index].children[index].Assigner == "Joe Thigpen"){
            my_tasks.push(this.all_datas[parent_index].children[index]);
            this.my_length++;
          }
          //Update team_data
          if(this.all_datas[parent_index].children[index].owner == "Joe Thigpen"){
            team_tasks.push(this.all_datas[parent_index].children[index]);
            this.team_length++;
          }
          if(this.all_datas[parent_index].children[index].DueDate != "")
          {

            //Update today_data
            if(this.all_datas[parent_index].children[index].DueDate == moment().format('YYYY-MM-DD')){
              today_tasks.push(this.all_datas[parent_index].children[index]);
              this.today_length++;
            }
            //Update tomorrow_data
            if(this.all_datas[parent_index].children[index].DueDate == moment().add(1, 'days').format('YYYY-MM-DD')){
              tomorrow_tasks.push(this.all_datas[parent_index].children[index]);
              this.tomorrow_length++;
            }
            //Update overdue_data
            if(moment(this.all_datas[parent_index].children[index].DueDate, 'YYYY-MM-DD').fromNow().startsWith('in')){
              overdue_tasks.push(this.all_datas[parent_index].children[index]);
              this.overdue_length++;
            }
          }
        });
        console.log(my_tasks);
        this.my_datas[parent_index]['children'] = my_tasks;
        this.team_datas[parent_index]['children'] = team_tasks;
        this.today_datas[parent_index]['children'] = today_tasks;
        this.tomorrow_datas[parent_index]['children'] = tomorrow_tasks;
        this.overdue_datas[parent_index]['children'] = overdue_tasks;
      });
      console.log(this.all_datas);
      this.$forceUpdate();
    },
    showSubTaskModal(param) {
      this.isSubTaskModalVisible = true;
    },
    closeSubTaskAdd() {
      console.log('closeAssignee')
      this.isSubTaskModalVisible = false;
    },
    saveSubTaskAdd(param) {
      this.isSubTaskModalVisible = false;
      console.log('addAssignee : ',param);
      var tmp_sub = param.row;
      tmp_sub.index = null;
      tmp_sub.Task = param.title;
      this.all_datas[param.parent_index]['children'][param.index]['sub_tasks'].push(tmp_sub);
      var url = this.routes.addSubtask;
      url = url.replace(':id',this.all_datas[param.parent_index]['children'][param.index].id);
      this.axios.post(url,{subTask:tmp_sub}).then(response => {
      });

    },
    showAssigneeModal(param) {
      this.isAssignModalVisible = true;
    },
    closeAssigneeAdd() {
      console.log('close')
      this.isAssignModalVisible = false;
    },
    saveAssigneeAdd(param) {
      this.isAssignModalVisible = false;
      var assignees = param.assignees;
      var url = this.routes.updateTask;
      console.log('addAssignees : ',param);
      if(param.task.row){
        var task  = param.task.row;
        task.user_id = assignees[0].id;
        this.axios.post(url,{task:task}).then(response => {
        });
      }
      else{
        var task  = param.task;
        task.forEach(item=>{
          item.user_id = assignees[0].id;
          this.axios.post(url,{task:item}).then(response => {
          });
        });
      }
    },
    showProjectsModal(param) {
      this.isProjectModalVisible = true;
    },
    closeProjectsAdd() {
      console.log('close')
      this.isProjectModalVisible = false;
    },
    saveProjectsAdd(param) {
      debugger;
      this.isProjectModalVisible = false;
      var url = this.routes.updateTask;
      console.log('addprojectss : ',param);
      var projects = param.mprojects;
      if(param.task.row){
        var task  = param.task.row;
        task.project_id = projects[0].id;
        task.project = projects[0].project_name;
        this.axios.post(url,{task:task}).then(response => {
        });
      }
      else{
        var task  = param.task;
        task.forEach(item=>{
          item.project_id = projects[0].id;
          item.project = projects[0].project_name;
          this.axios.post(url,{task:item}).then(response => {
          });
        });
      }
    },
    updateTable(task){
      this.all_datas.forEach((headerRow, parent_index) => {
        headerRow.children.forEach((row, index) => {
          if(task.ID == row.ID) {
            
            this.all_datas[parent_index].children[index] = task;
          }
        });
        this.updateSubDatas();
      });
    }
  },
  props: {
    allroutes: {
      type: [String, Object, Array],
      default: function () { return [] }  
    },
    datas: {
      type: [String, Object, Array],
      default: []
    },
    employees : {
      type: [String, Object, Array],
      default: []  
    },
    projects : {
      type: [String, Object, Array],
      default: []  
    },
    pro_clients : {
      type: [String, Object, Array],
      default: []  
    },
    pro_taskCat : {
      type: [String, Object, Array],
      default: function () { return [] }    
    },
    pro_proCat : {
      type: [String, Object, Array],
      default: function () { return [] }   
    },
    token : {
      type : String,
      default : ''
    },
    user : {
      type: [String, Object, Array],
      default: function () { return [] }  
    }
  },
  computed: {
    routes : function(){
      console.log(JSON.parse(this.allroutes));
      return JSON.parse(this.allroutes);
    },
    all_employeess : function(){
      return JSON.parse(this.employees);
    },
    clients:function(){
      return JSON.parse(this.pro_clients);
    },
    taskCat:function(){
      return JSON.parse(this.pro_clients);
    },
    proCat:function(){
      return JSON.parse(this.pro_clients);
    },
    all_projects : function(){
      return JSON.parse(this.projects);
    },
    currentUser: function(){
      return JSON.parse(this.user);
    }
  },
  created() {
    this.all_datas = JSON.parse(this.datas);  //check this part on your side..
    this.all_employees = JSON.parse(this.employees); 
  },
  mounted() {
    console.log(this.data);
  },
  watch: {
    all_datas: function() {
      console.log('update all datas');
      //Update all the datas & length
      this.updateSubDatas();
    }
  },
  data() {
    return {
      is_recurr: false,
      all_datas: [],
      all_employees: [],
      all_length: 0,
      my_datas: [],
      team_datas: [],
      today_datas: [],
      tomorrow_datas: [],
      overdue_datas: [],
      my_length: 0,
      team_length: 0,
      today_length: 0,
      tomorrow_length: 0,
      overdue_length: 0,
      filteredRows: [],
      columnFilters: [],
      hide_completed: false,
      isSubTaskModalVisible: false,
      isAssignModalVisible: false,
      isProjectModalVisible: false,
      addSubTaskParam: [],
      headers: [
        {
          label: "Task",
          field: "Task",
          width: "400px",
          filterable: true,
          filterOptions: {
            enabled: true, // enable filter for this column
            filterDropdownItems: [], // dropdown (with selected values) instead of text input
            trigger: "enter" //only trigger on enter not on keyup
          }
        },
        {
          label: "#Subtask",
          field: "Subtask",
          filterable: true,
          filterOptions: {
            enabled: true, // enable filter for this column
            filterDropdownItems: [], // dropdown (with selected values) instead of text input
            trigger: "enter" //only trigger on enter not on keyup
          }
        },
        {
          label: "#check-list",
          field: "checklist",
          width: "150px",
          filterable: true,
          filterOptions: {
            enabled: true, // enable filter for this column
            filterDropdownItems: [], // dropdown (with selected values) instead of text input
            trigger: "enter" //only trigger on enter not on keyup
          }
        },
        {
          label: "Project",
          field: "project",
          width: "250px",
          filterable: true,
          filterOptions: {
            enabled: true, // enable filter for this column
            filterDropdownItems: [], // dropdown (with selected values) instead of text input
            trigger: "enter" //only trigger on enter not on keyup
          }
        },
        {
          label: "Project Phase",
          field: "ProjectPhase",
          filterable: true,
          filterOptions: {
            enabled: true, // enable filter for this column
            filterDropdownItems: [], // dropdown (with selected values) instead of text input
            trigger: "enter" //only trigger on enter not on keyup
          }
        },
        {
          label: "Client",
          field: "Client",
          width: "150px",
          filterable: true,
          filterOptions: {
            enabled: true, // enable filter for this column
            filterDropdownItems: [], // dropdown (with selected values) instead of text input
            trigger: "enter" //only trigger on enter not on keyup
          }
        },
        {
          label: "Assignee",
          field: "Assignee",
          html: true,
          filterable: true,
          filterOptions: {
            enabled: true, // enable filter for this column
            filterDropdownItems: [], // dropdown (with selected values) instead of text input
            trigger: "enter" //only trigger on enter not on keyup
          }
        },
        {
          label: "Assigner",
          field: "Assigner",
          html: true,
          filterable: true,
          filterOptions: {
            enabled: true, // enable filter for this column
            filterDropdownItems: [], // dropdown (with selected values) instead of text input
            trigger: "enter" //only trigger on enter not on keyup
          }
        },
        {
          label: "Own",
          field: "Own",
          html: true,
          filterable: true,
          filterOptions: {
            enabled: true, // enable filter for this column
            filterDropdownItems: [], // dropdown (with selected values) instead of text input
            trigger: "enter" //only trigger on enter not on keyup
          }
        },
        {
          label: "Start Date",
          field: "StartDate",
          type: "date",
          width: "120px",
          filterable: true,
          dateInputFormat: "yyyy-MM-dd",
          dateOutputFormat: "dd-MM-yyyy",
          filterable: true,
          filterOptions: {
            enabled: true, // enable filter for this column
            filterDropdownItems: [], // dropdown (with selected values) instead of text input
            trigger: "enter" //only trigger on enter not on keyup
          }
        },
        {
          label: "Due Date",
          field: "DueDate",
          type: "date",
          width: "120px",
          filterable: true,
          dateInputFormat: "yyyy-MM-dd",
          dateOutputFormat: "dd-MM-yyyy",
          filterable: true,
          filterOptions: {
            enabled: true, // enable filter for this column
            filterDropdownItems: [], // dropdown (with selected values) instead of text input
            trigger: "enter" //only trigger on enter not on keyup
          }
        },
        {
          label: "Frequency",
          field: "frequency",
          filterable: true,
          filterable: true,
          filterOptions: {
            enabled: true, // enable filter for this column
            filterDropdownItems: [], // dropdown (with selected values) instead of text input
            trigger: "enter" //only trigger on enter not on keyup
          }
        },
        {
          label: "End Date",
          field: "EndDate",
          type: "date",
          width: "120px",
          filterable: true,
          dateInputFormat: "yyyy-MM-dd",
          dateOutputFormat: "dd-MM-yyyy",
          filterable: true,
          filterOptions: {
            enabled: true, // enable filter for this column
            filterDropdownItems: [], // dropdown (with selected values) instead of text input
            trigger: "enter" //only trigger on enter not on keyup
          }
        },
        {
          label: "Priority",
          field: "Priority",
          filterable: true,
          filterOptions: {
            enabled: true, // enable filter for this column
            filterDropdownItems: [], // dropdown (with selected values) instead of text input
            trigger: "enter" //only trigger on enter not on keyup
          }
        },
        {
          label: "Task Cat",
          field: "TaskCat",
          width : "150px",
          filterable: true,
          filterOptions: {
            enabled: true, // enable filter for this column
            filterDropdownItems: [], // dropdown (with selected values) instead of text input
            trigger: "enter" //only trigger on enter not on keyup
          }
        },
        {
          label: "Project Cat",
          field: "ProjectCat",
          width : "150px",
          filterable: true,
          filterOptions: {
            enabled: true, // enable filter for this column
            filterDropdownItems: [], // dropdown (with selected values) instead of text input
            trigger: "enter" //only trigger on enter not on keyup
          }
        },
        {
          label: "Est Hours",
          field: "EstHours",
          type: "number",
          filterable: true,
          filterOptions: {
            enabled: true, // enable filter for this column
            filterDropdownItems: [], // dropdown (with selected values) instead of text input
            trigger: "enter" //only trigger on enter not on keyup
          }
        },
        {
          label: "Actual Hours",
          field: "ActualHours",
          type: "number",
          filterable: true,
          filterOptions: {
            enabled: true, // enable filter for this column
            filterDropdownItems: [], // dropdown (with selected values) instead of text input
            trigger: "enter" //only trigger on enter not on keyup
          }
        },
        {
          label: "Created Date",
          field: "CreatedDate",
          type: "date",
          width: "120px",
          filterable: true,
          dateInputFormat: "yyyy-MM-dd",
          dateOutputFormat: "dd-MM-yyyy",
          filterOptions: {
            enabled: true, // enable filter for this column
            filterDropdownItems: [], // dropdown (with selected values) instead of text input
            trigger: "enter" //only trigger on enter not on keyup
          }
        },
        {
          label: "Section Titles",
          field: "sectionTitles",
          filterable: true,
          filterOptions: {
            enabled: true, // enable filter for this column
            filterDropdownItems: [], // dropdown (with selected values) instead of text input
            trigger: "enter" //only trigger on enter not on keyup
          }
        },
        {
          label: "Tags",
          field: "tags",
          filterable: true,
          filterOptions: {
            enabled: true, // enable filter for this column
            filterDropdownItems: [], // dropdown (with selected values) instead of text input
            trigger: "enter" //only trigger on enter not on keyup
          }
        },
        {
          label: "Status",
          field: "Status",
          filterable: true,
          html : true,
          filterOptions: {
            enabled: true, // enable filter for this column
            filterDropdownItems: [], // dropdown (with selected values) instead of text input
            trigger: "enter" //only trigger on enter not on keyup
          }
        }
      ],
      datas_sample: [
        {
          mode: "span", // span means this header will span all columns
          label: "Account Setup", // this is the label that'll be used for the header
          html: false, // if this is true, label will be rendered as html
          children: [
            {
              ID: 1,
              Task: "Setup Hosting",
              SubtaskPID: "",
              Subtask: "3/3",
              checklist: "",
              Project: "New Website",
              ProjectPhase: "Account Setup",
              Client: "Datagroup",
              Assignee:
                '<img src="http://workatask-dev1.rack360.net/portal/public/default-profile-2.png" alt="user" class="img-circle" width="30">Richard',
              Assigner:
                '<img src="http://workatask-dev1.rack360.net/portal/public/default-profile-2.png" alt="user" class="img-circle" width="30">Joe',
              Own:
                '<img src="http://workatask-dev1.rack360.net/portal/public/default-profile-2.png" alt="user" class="img-circle" width="30">Richard',
              StartDate: "2019-08-14",
              DueDate: "2019-08-14",
              Frequency: "",
              EndDate: "2019-09-14",
              Priority: "Med",
              TaskCat: "onboarding",
              ProjectCat: "website",
              EstHours: 4,
              ActualHours: 2.5,
              CreatedDate: "2019-07-09",
              SectionTitles: "Do Now",
              Tags: "hosting, migrate",
              Status: "incomplete"
            },
            {
              ID: 2,
              Task: "Register Domain",
              SubtaskPID: "",
              Subtask: "",
              checklist: "6/6",
              Project: "New Website",
              ProjectPhase: "Migrate",
              Client: "Datagroup",
              Assignee:
                '<img src="http://workatask-dev1.rack360.net/portal/public/default-profile-2.png" alt="user" class="img-circle" width="30">richard',
              Assigner:
                '<img src="http://workatask-dev1.rack360.net/portal/public/user-uploads/avatar/SpPIkW7OsG9ti4n7wK1179phxsUmHEKPDDa0NXpb.gif" alt="user" class="img-circle" width="30">Joe',
              Own:
                '<img src="http://workatask-dev1.rack360.net/portal/public/user-uploads/avatar/SpPIkW7OsG9ti4n7wK1179phxsUmHEKPDDa0NXpb.gif" alt="user" class="img-circle" width="30">Joe',
              StartDate: "2019-08-14",
              DueDate: "2019-08-14",
              Frequency: "",
              EndDate: "2019-09-14",
              Priority: "Med",
              TaskCat: "migration",
              ProjectCat: "website",
              EstHours: 1,
              ActualHours: 0.5,
              CreatedDate: "2019-07-09",
              SectionTitles: "Do Now",
              Tags: "hosting, migrate",
              Status: "complete"
            },
            {
              ID: 3,
              Task: "Purchase hosting plan",
              SubtaskPID: "",
              Subtask: "",
              checklist: "0/1",
              Project: "New Website",
              ProjectPhase: "Migrate",
              Client: "Datagroup",
              Assignee:
                '<img src="http://workatask-dev1.rack360.net/portal/public/default-profile-2.png" alt="user" class="img-circle" width="30">richard',
              Assigner:
                '<img src="http://workatask-dev1.rack360.net/portal/public/user-uploads/avatar/SpPIkW7OsG9ti4n7wK1179phxsUmHEKPDDa0NXpb.gif" alt="user" class="img-circle" width="30">Joe',
              Own:
                '<img src="http://workatask-dev1.rack360.net/portal/public/user-uploads/avatar/SpPIkW7OsG9ti4n7wK1179phxsUmHEKPDDa0NXpb.gif" alt="user" class="img-circle" width="30">Joe',
              StartDate: "2019-08-14",
              DueDate: "2019-08-14",
              Frequency: "Weekly",
              EndDate: "2019-09-14",
              Priority: "Med",
              TaskCat: "migration",
              ProjectCat: "website",
              EstHours: 1,
              ActualHours: 0.5,
              CreatedDate: "2019-07-09",
              SectionTitles: "Do Now",
              Tags: "hosting, migrate",
              Status: "incomplete"
            },
            {
              ID: 4,
              Task: "Setup billing",
              SubtaskPID: "",
              Subtask: "0/1",
              checklist: "",
              Project: "New Website",
              ProjectPhase: "Migrate",
              Client: "Datagroup",
              Assignee:
                '<img src="http://workatask-dev1.rack360.net/portal/public/default-profile-2.png" alt="user" class="img-circle" width="30">Richard',
              Assigner:
                '<img src="http://workatask-dev1.rack360.net/portal/public/user-uploads/avatar/SpPIkW7OsG9ti4n7wK1179phxsUmHEKPDDa0NXpb.gif" alt="user" class="img-circle" width="30">Joe',
              Own:
                '<img src="http://workatask-dev1.rack360.net/portal/public/user-uploads/avatar/SpPIkW7OsG9ti4n7wK1179phxsUmHEKPDDa0NXpb.gif" alt="user" class="img-circle" width="30">Joe',
              StartDate: "2019-08-14",
              DueDate: "2019-08-14",
              Frequency: "Weekly",
              EndDate: "2019-09-14",
              Priority: "Med",
              TaskCat: "migration",
              ProjectCat: "website",
              EstHours: 1,
              ActualHours: 0.5,
              CreatedDate: "2019-07-09",
              SectionTitles: "Do Now",
              Tags: "hosting, migrate",
              Status: "incomplete"
            }
          ]
        },
        {
          mode: "span", // span means this header will span all columns
          label: "Research", // this is the label that'll be used for the header
          html: false, // if this is true, label will be rendered as html
          children: [
            {
              ID: 5,
              Task: "Parent Task",
              SubtaskPID: "",
              Subtask: "0/1",
              checklist: "",
              Project: "Website",
              ProjectPhase: "Research",
              Client: "Datagroup",
              Assignee:
                '<img src="http://workatask-dev1.rack360.net/portal/public/default-profile-2.png" alt="user" class="img-circle" width="30">Richard',
              Assigner:
                '<img src="http://workatask-dev1.rack360.net/portal/public/user-uploads/avatar/SpPIkW7OsG9ti4n7wK1179phxsUmHEKPDDa0NXpb.gif" alt="user" class="img-circle" width="30">Joe',
              Own:
                '<img src="http://workatask-dev1.rack360.net/portal/public/user-uploads/avatar/SpPIkW7OsG9ti4n7wK1179phxsUmHEKPDDa0NXpb.gif" alt="user" class="img-circle" width="30">Joe',
              StartDate: "2019-08-14",
              DueDate: "2019-08-14",
              Frequency: "Weekly",
              EndDate: "2019-09-14",
              Priority: "Med",
              TaskCat: "onboarding",
              ProjectCat: "website",
              EstHours: 4,
              ActualHours: 2.5,
              CreatedDate: "2019-07-09",
              SectionTitles: "Do Now",
              Tags: "hosting, migrate",
              Status: "incomplete"
            },
            {
              ID: 6,
              Task: "Subtask 1",
              SubtaskPID: "",
              Subtask: "6/6",
              checklist: "",
              Project: "Website",
              ProjectPhase: "Research",
              Client: "Datagroup",
              Assignee:
                '<img src="http://workatask-dev1.rack360.net/portal/public/default-profile-2.png" alt="user" class="img-circle" width="30">Richard',
              Assigner:
                '<img src="http://workatask-dev1.rack360.net/portal/public/user-uploads/avatar/SpPIkW7OsG9ti4n7wK1179phxsUmHEKPDDa0NXpb.gif" alt="user" class="img-circle" width="30">Joe',
              Own:
                '<img src="http://workatask-dev1.rack360.net/portal/public/user-uploads/avatar/SpPIkW7OsG9ti4n7wK1179phxsUmHEKPDDa0NXpb.gif" alt="user" class="img-circle" width="30">Joe',
              StartDate: "2019-08-14",
              DueDate: "2019-08-14",
              Frequency: "Monthly",
              EndDate: "2019-09-14",
              Priority: "Med",
              TaskCat: "onboarding",
              ProjectCat: "website",
              EstHours: 4,
              ActualHours: 2.5,
              CreatedDate: "2019-07-09",
              SectionTitles: "Do Now",
              Tags: "hosting, migrate",
              Status: "incomplete"
            }
          ]
        },
        {
          mode: "span", // span means this header will span all columns
          label: "Unmastched", // this is the label that'll be used for the header
          html: false, // if this is true, label will be rendered as html
          children: [
            {
              ID: 7,
              Task: "Weekly Blog Selection",
              SubtaskPID: 1,
              Subtask: "0/2",
              checklist: "",
              Project: "Ongoing Blogs",
              ProjectPhase: "",
              Client: "highclick",
              Assignee:
                '<img src="http://workatask-dev1.rack360.net/portal/public/default-profile-2.png" alt="user" class="img-circle" width="30">Richard',
              Assigner:
                '<img src="http://workatask-dev1.rack360.net/portal/public/user-uploads/avatar/SpPIkW7OsG9ti4n7wK1179phxsUmHEKPDDa0NXpb.gif" alt="user" class="img-circle" width="30">Joe',
              Own:
                '<img src="http://workatask-dev1.rack360.net/portal/public/user-uploads/avatar/SpPIkW7OsG9ti4n7wK1179phxsUmHEKPDDa0NXpb.gif" alt="user" class="img-circle" width="30">Joe',
              StartDate: "2019-08-14",
              DueDate: "2019-08-14",
              Frequency: "Weekly",
              EndDate: "2019-09-14",
              Priority: "Med",
              TaskCat: "onboarding",
              ProjectCat: "website",
              EstHours: 1,
              ActualHours: 0.2,
              CreatedDate: "2019-07-09",
              SectionTitles: "Do Now",
              Tags: "hosting, migrate",
              Status: "incomplete"
            },
            {
              ID: 8,
              Task: "Write Blog Article",
              SubtaskPID: 1,
              Subtask: "",
              checklist: "",
              Project: "Ongoing Blogs",
              ProjectPhase: "",
              Client: "Highclick",
              Assignee:
                '<img src="http://workatask-dev1.rack360.net/portal/public/default-profile-2.png" alt="user" class="img-circle" width="30">Richard',
              Assigner:
                '<img src="http://workatask-dev1.rack360.net/portal/public/user-uploads/avatar/SpPIkW7OsG9ti4n7wK1179phxsUmHEKPDDa0NXpb.gif" alt="user" class="img-circle" width="30">Joe',
              Own:
                '<img src="http://workatask-dev1.rack360.net/portal/public/user-uploads/avatar/SpPIkW7OsG9ti4n7wK1179phxsUmHEKPDDa0NXpb.gif" alt="user" class="img-circle" width="30">Joe',
              StartDate: "2019-08-14",
              DueDate: "2019-08-14",
              Frequency: "Weekly",
              EndDate: "2019-09-14",
              Priority: "Med",
              TaskCat: "onboarding",
              ProjectCat: "website",
              EstHours: 1,
              ActualHours: 0.2,
              CreatedDate: "2019-07-09",
              SectionTitles: "Do Now",
              Tags: "hosting, migrate",
              Status: "incomplete"
            },
            {
              ID: 9,
              Task: "Wash Car",
              SubtaskPID: 1,
              Subtask: "",
              checklist: "",
              Project: "New Website",
              ProjectPhase: "Account Setup",
              Client: "Datagroup",
              Assignee:
                '<img src="http://workatask-dev1.rack360.net/portal/public/default-profile-2.png" alt="user" class="img-circle" width="30">Richard',
              Assigner:
                '<img src="http://workatask-dev1.rack360.net/portal/public/user-uploads/avatar/SpPIkW7OsG9ti4n7wK1179phxsUmHEKPDDa0NXpb.gif" alt="user" class="img-circle" width="30">Joe',
              Own:
                '<img src="http://workatask-dev1.rack360.net/portal/public/user-uploads/avatar/SpPIkW7OsG9ti4n7wK1179phxsUmHEKPDDa0NXpb.gif" alt="user" class="img-circle" width="30">Joe',
              StartDate: "2019-08-14",
              DueDate: "2019-08-14",
              Frequency: "Weekly",
              EndDate: "2019-09-14",
              Priority: "Med",
              TaskCat: "onboarding",
              ProjectCat: "website",
              EstHours: 1,
              ActualHours: 0.2,
              CreatedDate: "2019-07-09",
              SectionTitles: "Do Now",
              Tags: "hosting, migrate",
              Status: "incomplete"
            }
          ]
        }
      ],
    };
  }
};
</script>
