<template>
  <div>
    <button @click="toggleShow" @blur="loosefocus" variant="outline" class="anchor">
      <img v-if="img!=''" :src="img" class="img"></img>
      <i v-if="icon!=''" :class="icon" style="font-size: 20px;"></i>
    </button>
    <div v-if="showMenu" class="menu" v-bind:style="right">
      <div class="menu-item" v-for="item in this.items" @mousedown="itemClicked(item)">{{item}}</div>
    </div>
  </div>
</template>
<style >
  .menu{
    color  :#777;
  }
  .menu-item{
    display: block;
    width: 100%;
    padding: .25rem 1.5rem;
    clear: both;
    font-weight: 400;
    color: #777;
    text-align: inherit;
    white-space: nowrap;
    background-color: transparent;
    border: 0;
    font-size:15px;
  }
</style>
<script>
export default {
  name: "dropdown",
  props: {
    img: {
      type: String,
      default: ""
    },
    icon: {
      type: String,
      default: ""
    },
    items: {
      type: [Object, Array],
      default: []
    },
    row: {
      type: [Object, Array],
    },
    index: {
      type: Number,
      default: 0
    },
    parent_index: {
      type: Number,
      default: 0
    },
    right: {
      type: String,
    }
  },
  data() {
    return {
      showMenu: false
    };
  },
  methods: {
    toggleShow() {
      this.showMenu = !this.showMenu;
    },
    itemClicked(item) {
      console.log(item);
      this.toggleShow();
      var param = [];
      param.item=item;
      param.row=this.row;
      param.index=this.index;
      param.parent_index=this.parent_index;

      this.$emit("on-click", param);
    },
    async loosefocus() {
      console.log('blur');
      this.showMenu = false;
    }
  }
};
</script>

<style scoped>
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

.anchor:hover {
  color: rgb(128, 128, 128);
  cursor: pointer;
}
.img {
  padding-left: 10px;
  width: 30px;
}
.menu {
  z-index: 1;
  background-color: #fff;
  background-clip: padding-box;
  border: 1px solid rgba(0, 0, 0, 0.15);
  border-radius: 0.25rem;
  color: #212529;
  cursor: pointer;
  display: flex;
  flex-direction: column;
  font-size: 1rem;
  list-style: none;
  margin: 0.125rem 0 0;
  padding: 0.5rem 0;
  position: absolute;
  text-align: left;
  width: max-content;
}
.menu-item {
  color: #212529;
  padding: 0.25rem 1.5rem;
}
.menu-item:hover {
  background-color: #f4f6f6;
  cursor: pointer;
}
</style>
