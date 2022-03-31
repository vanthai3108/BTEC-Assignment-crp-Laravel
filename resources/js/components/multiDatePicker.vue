<template>
  <div class="form-group">
    <label for="dates">Dates:</label>
    <div class="dp-mask" v-show="panelShow" @click="panelShow = false"></div>
    <div class="selected-date col col-12 mr-0" @click="panelShow = !panelShow">
      <div style="display: flex;flex-wrap: wrap;" v-if="multi">
        <!-- <label for="dates">Selected dates:</label> -->

        <div class="sel-values" v-for="(item,index) in selected" :key="index" >
          {{format(item)}}
        </div>
        <input type="hidden" name="dates[]" v-for="(item,index) in selected" 
          :value="format(item, 'Y-m-d')" 
          :key="'D'+index" />
      </div>
      <div v-else>
        {{selected ? format(selected) : ''}}
      </div>
    </div>
    <transition name="smooth">
      <div class="pick-panel col-11" :style="{'position': alwaysDisplay ? 'inherit' : 'absolute'}" v-show="alwaysDisplay || panelShow">
        <div class="dp-header">
          <div class="btn btn-link last-year" @click="seleYear--"></div>
          <div class="btn btn-link last-month" @click="changeMonth(-1)"></div>
          <div class="btn btn-link sele-year">
            {{seleYear}}
            <span v-if="lang != 'en' || !!disp">{{display.year}}</span>
          </div>
          <div class="btn btn-link sele-month">
            <span v-if="lang === 'en' && !disp">{{monthNames[seleMonth]}}</span>
            <span v-else>{{seleMonth+1}}{{display.month}}</span>
          </div>
          <div class="btn btn-link next-month" @click="changeMonth(1)"></div>
          <div class="btn btn-link next-year" @click="seleYear++"></div>
        </div>
        <div class="dp-body">
          <div class="cal-container">
            <div class="cal-item" v-for="day in display.days" :key="day">{{day}}</div>
            <div class="cal-item" 
            @click="toggleSelect(item)" 
            v-for="(item,index) in renderCalendar" :key="index" 
            :class="[item.iscur? 'cal-enable' : 'cal-disable', selectIndex(item) >= 0  ? 'cal-select' : '']">
              {{item.label}}
            </div>
          </div>
        </div>
        <div class="dp-footer" v-show="multi">
          <div class="btn btn-cancel" @click="cancelSelect">{{alwaysDisplay ? display.clear : display.cancel}}</div>
          <div v-if="!alwaysDisplay" class="btn btn-ok" @click="submitSelect(selected)">{{display.ok}}</div>
        </div>
      </div>
    </transition>
  </div>
</template>
<script>

export default {

}
</script>
<script src="./multiDatePicker.js"></script>

<style src="./multiDatePicker.css"></style>
