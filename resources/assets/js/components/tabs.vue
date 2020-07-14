<template>
  <div class="vueNav">
    <nav
      class="navbar navbar-default"
      style="background-color : transparent !important; margin-bottom: 0px; !important; display: flex; align-items: center;"
    >
      <ul class="nav navbar-nav">
        <li v-for="tab in tabs" v-if="tab.name" :class="{ 'is-active': tab.isActive }">
          <a style="font-size:15px;" :href="tab.href" @click="selectTab(tab)">{{ tab.name }}</a>
        </li>
      </ul>
      <div style="display:flex;margin:auto;">
        <button @click="groupby()" style="margin-right:20px;" variant="outline" class="anchor">
          <i class="fa fa-object-group" style="font-size: 20px;"></i>
        </button>
        <dropdown
          icon="fa fa-cog"
          right="right: 0"
          @on-click="settingClick"
          :items="showCompletedTask==false?[item_hideCompletedTask, 'Hide/Show  Columns', 'Add new Column (Admin Only)', 'Rearrange column order', 'Export to Excel' ]:[item_showCompletedTask, 'Hide/Show  Columns', 'Add new Column (Admin Only)', 'Rearrange column order', 'Export to Excel' ]"
        ></dropdown>

      </div>
      
    </nav>

    <div class="tabs-details">
      <slot></slot>
    </div>
  </div>
</template>
<style>
.anchor {
  display: flex;
  width: 30px;
  align-items: center;
  justify-content: center;
  border: 1px solid transparent;
  font-size: 1rem;
  border-radius: 0.25rem;
  background: transparent;
}
.is-active {
  color: #fec107;
  border-bottom: 5px solid;
}
.is-active a {
  color: #fec107 !important;
}
.vueNav nav span {
  /* align-items: center;
  justify-content: center;
  float: right;
  font-size: 25px;
  margin: 10px 20px; */
  position: absolute;
}
</style>
<script>
import dropdown from "./Dropdown.vue";
export default {
  name: "myTabs",
  components: {
    dropdown
  },
  data() {
    return { 
      tabs: [],
      showCompletedTask : false,
      item_hideCompletedTask : 'Hide completed task',
      item_showCompletedTask : 'Show completed task'
    };
  },
  created() {
    this.tabs = this.$children;
  },
  methods: {
    selectTab(selectedTab) {
      this.tabs.forEach(tab => {
        tab.isActive = tab.name == selectedTab.name;
      });
    },
    settingClick(item) {
      console.log("settings : ",item);

      if(item.item == this.item_hideCompletedTask){
        this.showCompletedTask = true;
      }
      if(item.item == this.item_showCompletedTask){
        this.showCompletedTask = false;
      }
      console.log(item);
      this.$emit('setting-click', item);
    },
    groupby() {
      this.$emit('group-by', null);
    }
  }
};
</script>