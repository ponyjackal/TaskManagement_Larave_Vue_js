<template> 
    <vue-good-table
        :columns="headers"
        :employees="employees"
        :rows="datas"
        :clients = "clients"
        :taskCat = "taskCat"
        :proCat = "proCat"
        :search-options="{
            enabled: true,
            trigger: 'enter',
        }"
        :pagination-options="{
            enabled: true,
            mode: 'records',
            perPage: 25,
            position: 'top',
            perPageDropdown: [10, 25, 50],
            dropdownAllowAll: false,
            setCurrentPage: 1,
            nextLabel: 'next',
            prevLabel: 'prev',
            rowsPerPageLabel: 'Show',
            ofLabel: 'of',
            pageLabel: 'page', // for 'pages' mode
            allLabel: 'All',
        }"
        :selectOptions="{
            enabled: true,
            selectOnCheckboxOnly: true, // only select when checkbox is clicked instead of the row
            selectionInfoClass: 'custom-class',
            selectionText: 'rows selected',
            clearSelectionText: 'clear',
            disableSelectInfo: true, // disable the select info panel on top
        }"
        :groupOptions="{
            enabled: true
        }"
        :hide_completed="hide_completed"
        @add-new="addNew"
        @row-single-action="rowSingleAction"
        @row-multiple-action="rowMultipleAction"
        @add-new-input="addNewInput"
        @on-move="onMove"
        @on-complete-edit="updateTask"
        @on-column-filter="onColumnFilter"
        @recurr-dialog="recurrDialog"
        styleClass="vgt-table bordered"
        hide-actions
        ref="sortableTable"
        >
        <template  slot="table-row" slot-scope="props">
                <span v-if="props.column.field == 'Subtask'" >
                    <span v-if="props.row.Subtask != ''">{{props.row.Subtask}}</span>
                    <span v-if="props.row.Subtask == ''">-</span>
                </span>
                <span v-else-if="props.column.field == 'checklist'" >
                    <span v-if="props.row.checklist != ''">{{props.row.checklist}}</span>
                    <span v-if="props.row.checklist == ''">-</span>
                </span>
                <span v-else-if="props.column.field == 'DueDate'" >
                    <span  style="color: #337ab7;">{{props.row.DueDate}}</span>
                </span>
                <span v-else-if="props.column.field == 'Status'">
                    <span v-if="props.row.Status == 'complete'" style="justify-content: center;"><label class="label" style="background-color: green;">Complete</label></span>
                    <span v-if="props.row.Status == 'incomplete'" style="justify-content: center;"><label class="label" style="background-color: #d21010">Incomplete</label></span> 
                </span>
                <span style="display: flex; align-items: center;" v-else v-html = "props.formattedRow[props.column.field]">
                </span>
        </template>
    </vue-good-table>
</template>

<style>
</style>
<script>
    import VueGoodTable from './Table';
    export default {
        name : "CustomTable",
        components: {
            VueGoodTable,
        },
        props: {
            headers: { default: null, type: [Object, Array] },
            datas: { default: null, type: [Object, Array] },
            employees : {
                type: [String, Object, Array],
                default: []  
            },
            clients:{default: null, type: [Object, Array]},
            taskCat:{default: null, type: [Object, Array]},
            proCat:{default: null, type: [Object, Array]},
            hide_completed: { default: false, type: [Boolean] }
        },
        data() {
            return {};
        },
        methods: {
            addNew(param) {
                this.$emit('add-new', param);
            },
            addNewInput(param) {
                this.$emit('add-new-input', param);
            },
            rowSingleAction(param) {
                this.$emit('row-single-action', param);
            },
            rowMultipleAction(param) {
                this.$emit('row-multiple-action', param);
            },
            onColumnFilter(params) {
                this.$emit('on-column-filter', params);
            },
            recurrDialog(params) {
                this.$emit('recurr-dialog', params);
            },
            updateTask(param){
                this.$emit('on-complete-edit',param);
            },
            onMove(params){
                console.log(params);
                this.$emit('on-move',params);
            }
        },
    }
</script>
