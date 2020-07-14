<template>
  <transition name="modal">
    <div class="modal-mask">
      <div class="modal-wrapper">
        <div class="container" style="background-color:#fff;">
          <div class="modal-header">
            <slot name="header">
              <h3>Task Recurrence</h3>
            </slot>
          </div>

          <div class="modal-body" style="display: flex; margin:0px;">
            <slot name="body">
              <div class="col-md-6">
                <h4>Recurrence Pattern</h4>
                <div class="col-md-3">
                  
                  <label style="width:80%"><input type="radio" value="daily" v-model="reccPattern" checked />Daily</label>
                  <label style="width:80%"><input type="radio" value="weekly" v-model="reccPattern" />Weekly</label>
                  <label style="width:80%"><input type="radio" value="monthly" v-model="reccPattern" />Monthly</label>
                  <label style="width:80%"><input type="radio" value="yearly" v-model="reccPattern" />Yearly</label>
                </div>
                <!-- Daily Option -->
                <div v-if="reccPattern=='daily'" class="col-md-9">
                  <div class="col-md-12" style="display:flex;margin-bottom:10px;">
                    <label><input type="radio" value="daily" v-model="recPat_daily" checked/>Every</label>
                    <input class="form-control input_style" v-model="daily_day" type="number" style="width: 70%;" />
                    <label>Day(s)</label>
                  </div>
                  <div class="col-md-12" style="display:flex;margin-bottom:10px;">
                    <label><input type="radio" value="every_weekday" v-model="recPat_daily" />Every Weekday</label>
                  </div>
                  <div class="col-md-12" style="display:flex;margin-bottom:10px;">
                    
                    <label><input type="radio" value="days" v-model="recPat_daily" />Days</label>
                    <input class="form-control input_style" v-model="daily_days" placeholder="(1,3,7,11,31)" style="width: 70%;" />
                  </div>
                </div>
                <!-- Weekly Option -->
                <div v-if="reccPattern=='weekly'" class="col-md-9">
                  <div class="col-md-12" style="display:flex;margin-bottom:10px;">
                    <label>Recur every</label>
                    <input class="form-control input_style"
                      v-model="weekly_every_days"
                      type="number"
                      placeholder="1"
                      style="width: 50%;"
                    />
                    <label>week(s) on</label>
                  </div>
                  <div class="col-md-12">
                    <input  type="checkbox" v-model="weekly_monday" /> Monday
                    <input  type="checkbox" v-model="weekly_tuseday" /> Tuseday
                    <input  type="checkbox" v-model="weekly_wednesday" /> Wednesday
                    <input  type="checkbox" v-model="weekly_thirsday" />Thirsday
                  </div>
                  <div class="col-md-12" >
                    <input  type="checkbox" v-model="weekly_friday" /> Friday
                    <input  type="checkbox" v-model="weekly_saturday" /> Saturday
                    <input  type="checkbox" v-model="weekly_sunday" /> Sunday
                  </div>
                </div>

                <!-- Monthly Option -->
                <div v-if="reccPattern=='monthly'" class="col-md-9">
                  <div class="col-md-12">
                    <label style="display:flex;margin-bottom:10px;"><input type="radio" value="day" v-model="recPat_monthly" checked/>Day<input class="form-control input_style" v-model="monthly_day_day" type="number" style="width:30%;" />
                    <label>of every</label>
                    <input class="form-control input_style" v-model="monthly_day_month" type="number" style="width:30%;" />
                    <label>month(s)</label></label>
                  </div>
                  <div class="col-md-12">
                    <label style="display:flex;margin-bottom:10px;"><input type="radio" value="week" v-model="recPat_monthly" checked/>The
                    <select class="form-control input_style" v-model="monthly_week_no" style="width: 25%;">
                      <option value="first">First</option>
                      <option value="second">Second</option>
                      <option value="third">Third</option>
                      <option value="fourth">Fourth</option>
                      <option value="fifth">Fifth</option>
                    </select>
                    <select class="form-control input_style" v-model="monthly_week" style="width: 25%;">
                      <option value="monday">Monday</option>
                      <option value="tuseday">Tuseday</option>
                      <option value="Wednesday">Wednesday</option>
                      <option value="thirsday">Thirsday</option>
                      <option value="friday">Friday</option>
                      <option value="saturday">Saturday</option>
                      <option value="sunday">Sunday</option>
                    </select>
                    <label>of every</label>
                    <input class="form-control input_style" v-model="monthly_week_month" type="number" style="width: 50px;" />
                    <label>month(s)</label></label>
                    
                  </div>
                </div>
                <!-- Yearly Option -->
                <div v-if="reccPattern=='yearly'" class="col-md-9">
                  <div class="col-md-12" style="display:flex;margin-bottom:10px;">
                    <label>Recur every</label>
                    <input class="form-control input_style" v-model="yearly" style="width: 50px;" checked /> year(s)
                  </div>
                  <div class="col-md-12" style="display:flex;margin-bottom:10px;">
                    <label><input type="radio" value="day_on" v-model="recPat_yearly" />on:</label>                    
                    <select class="form-control input_style" v-model="yearly_day_month" style="width: 50%;">
                      <option value="January">January</option>
                      <option value="February">February</option>
                      <option value="March">March</option>
                      <option value="April">April</option>
                      <option value="May">May</option>
                      <option value="June">June</option>
                      <option value="July">July</option>
                      <option value="August">August</option>
                      <option value="September">September</option>
                      <option value="October">October</option>
                      <option value="November">November</option>
                      <option value="December">December</option>
                    </select>
                    <input class="form-control input_style" v-model="yearly_day_day" type="number" style="width:20%;" />
                  </div>

                  <div class="col-md-12" style="display:flex;margin-bottom:10px;">
                    <label><input type="radio" value="week_on" v-model="recPat_yearly" />on the:</label>
                    
                    <select class="form-control input_style" v-model="yearly_week_no" style="width: 25%;">
                      <option value="first">First</option>
                      <option value="second">Second</option>
                      <option value="third">Third</option>
                      <option value="fourth">Fourth</option>
                      <option value="fifth">Fifth</option>
                    </select>
                    <select class="form-control input_style" v-model="yearly_week_week" style="width: 25%;">
                      <option value="monday">Monday</option>
                      <option value="tuseday">Tuseday</option>
                      <option value="Wednesday">Wednesday</option>
                      <option value="thirsday">Thirsday</option>
                      <option value="friday">Friday</option>
                      <option value="saturday">Saturday</option>
                      <option value="sunday">Sunday</option>
                    </select>
                    of
                    <select class="form-control input_style" v-model="yearly_week_month"  style="width: 25%;">
                      <option value="January">January</option>
                      <option value="February">February</option>
                      <option value="March">March</option>
                      <option value="April">April</option>
                      <option value="May">May</option>
                      <option value="June">June</option>
                      <option value="July">July</option>
                      <option value="August">August</option>
                      <option value="September">September</option>
                      <option value="October">October</option>
                      <option value="November">November</option>
                      <option value="December">December</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="col-md-6" style="border-left: outset;">
                <h4>Range of Recurrence</h4>
                <div class="col-md-3" style="display:flex;margin-bottom:10px;">
                  <label>Start</label>
                  <input class="form-control input_style" type="date" v-model="start_date" />
                </div>
                <div class="col-md-9">
                  <div class="col-md-3" style="text-align: right;">
                    <label>End</label>
                  </div>
                  <div class="col-md-9" >
                    <div style="display:flex;margin-bottom:10px;">
                      <input type="radio" value="range_noend" v-model="rangeRecc" /> No end date
                    </div>
                    <div style="display:flex;margin-bottom:10px;">
                      <input type="radio" value="range_after" v-model="rangeRecc" />
                      End after:
                      <input class="form-control input_style" v-model="rangeRecc_end_occur" style="width:50px;"/>
                      occurrences
                    </div>
                    <div style="display:flex;margin-bottom:10px;">
                      <input type="radio" value="range_by" v-model="rangeRecc" />
                      <label>End by:</label>
                      <input class="form-control input_style" type="date" v-model="rangeRecc_end_date" />
                    </div>
                  </div>
                </div>
              </div>
            </slot>
          </div>

          <div class="modal-footer">
            <slot name="footer">
              <button class="btn btn-danger"  @click="$emit('cancel')">Cancel</button>
              <button class="btn btn-success" @click="okClicked()">Save</button>
            </slot>
          </div>
        </div>
      </div>
    </div>
  </transition>
</template>

<script>
// This components will have the content for each stepper step.
export default {
  name: "RecurrDialog",
  components: {},
  props: {},
  data() {
    return {
      //   demoSteps: [
      //     {
      //       icon: "mail",
      //       name: "first",
      //       title: "Recurrence Pattern",
      //       //   subtitle: "Subtitle sample",
      //       component: Pattern,
      //       completed: true
      //     },
      //     {
      //       icon: "report_problem",
      //       name: "second",
      //       title: "Range of Recurrence",
      //       component: Recurrence,
      //       completed: true
      //     }
      //   ]
      steps: [
        {
          label: "Task Recurrence",
          slot: "page1"
        },
        {
          label: "Range of Recurrence",
          slot: "page2"
        }
      ],
      //Recurrence Patterns
      reccPattern: "",
      //recPat / daily
      recPat_daily: "",
      daily_day: "0",
      daily_days: "",
      //recPat / weekly
      weekly_every_days: "",
      weekly_monday: "",
      weekly_tuesday: "",
      weekly_wednesday: "",
      weekly_thirsday: "",
      weekly_friday: "",
      weekly_saturday: "",
      weekly_sunday: "",
      //recPat / monthly
      recPat_monthly: "",
      monthly_day_day: "",
      monthly_day_month: "January",
      monthly_week_no: "first",
      monthly_week: "monday",
      monthly_week_month: 0,
      //recPat / yearly
      recPat_yearly: "",
      yearly_day_month: "January",
      yearly_day_day: "",
      yearly_week_no: "first",
      yearly_week_week: "monday",
      yearly_week_month: "January",
      //Range of Recurrence
      rangeRecc: "",
      rangeRecc_end_occur: "",
      rangeRecc_end_date: ""
    };
  },
  methods: {
    okClicked() {
      var param = [];
      param.pattern_type = this.reccPattern;

      param.rangeRecc = this.rangeRecc;
      this.$emit("save", param);
      return true; //return false if you want to prevent moving to next page
    },
  }
};
</script>

<style scoped>
.modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: table;
  transition: opacity 0.3s ease;
}
.input_style{
  margin-right : 5px;
  margin-left : 5px;
}
.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}

.modal-container {
  width: 300px;
  margin: 0px auto;
  padding: 20px 30px;
  background-color: #fff;
  border-radius: 2px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
  transition: all 0.3s ease;
  font-family: Helvetica, Arial, sans-serif;
}

.modal-header h3 {
  margin-top: 0;
  color: #42b983;
}

.modal-body {
  margin: 20px 0;
}

.modal-default-button {
  float: right;
}

/*
 * The following styles are auto-applied to elements with
 * transition="modal" when their visibility is toggled
 * by Vue.js.
 *
 * You can easily play with the modal transition by editing
 * these styles.
 */

.modal-enter {
  opacity: 0;
}

.modal-leave-active {
  opacity: 0;
}

.modal-enter .modal-container,
.modal-leave-active .modal-container {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}
</style>