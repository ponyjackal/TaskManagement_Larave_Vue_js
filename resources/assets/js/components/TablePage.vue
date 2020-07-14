<template>
    <custom-table :headers="headers" :datas="datas"></custom-table>
</template>

<style>
</style>
<script>
import CustomTable from "./CustomTable";

export default {
  name: "TablePage",
  components: {
    CustomTable,
  },
  data() {
    return {
      headers: [
        {
          label: "Task",
          field: "Task",
          width: "250px",
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
          width: "250px",
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
          field: "Frequency",
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
          field: "taskCat",
          filterable: true,
          filterOptions: {
            enabled: true, // enable filter for this column
            filterDropdownItems: [], // dropdown (with selected values) instead of text input
            trigger: "enter" //only trigger on enter not on keyup
          }
        },
        {
          label: "Project Cat",
          field: "projectCat",
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
          filterOptions: {
            enabled: true, // enable filter for this column
            filterDropdownItems: [], // dropdown (with selected values) instead of text input
            trigger: "enter" //only trigger on enter not on keyup
          }
        }
      ],
      datas: [
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
              ID: 3,
              Task: "Setup billing",
              SubtaskPID: "",
              Subtask: "",
              checklist: "0/1",
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
      ]
    };
  },

  methods: {},

  mounted() {
    console.log("Component mounted.");
    let table = document.querySelector("vgt-table tbody");
    const _self = this;
    // new Sortable(
    //     this.$refs.sortableTable.$el.getElementsByTagName('tbody')[0],
    //     {
    //         draggable: '.sortableRow',
    //         handle: '.sortHandle',
    //         onEnd: this.dragReorder
    //     }
    // )
  }
};
</script>
