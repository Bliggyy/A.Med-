<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <form @submit.prevent>
          <div v-if="$props.acc_type == 'patient'">
            <div class="form-group">
              <label for="specialization">Specialization</label>
              <select class="form-control" name="specialization" v-model="specialization" required>
                <option selected disabled>Select Specialization</option>
                <option value="Cardiologist">Cardiologist</option>
                <option value="Audiologist">Audiologist</option>
                <option value="ENT specialist">ENT specialist</option>
                <option value="Gynaecologist">Gynaecologist</option>
                <option value="Orthopaedic surgeon">Orthopaedic surgeon</option>
                <option value="Paediatrician">Paediatrician</option>
                <option value="Psychiatrists">Psychiatrists</option>
                <option value="Radiologist">Radiologist</option>
                <option value="Pulmonologist">Pulmonologist</option>
                <option value="Endocrinologist">Endocrinologist</option>
                <option value="Oncologist">Oncologist</option>
                <option value="Neurologist">Neurologist</option>
                <option value="Cardiothoracic surgeon">Cardiothoracic surgeon</option>
              </select>
            </div>
            <div class="form-group">
              <label for="doctors">Doctor List</label>
              <select class="form-control" name="doctor_list" v-model="newEvent.doc_id" :disabled="docListActivated == 1" required>
                <option selected disabled>Choose a doctor</option>
                <option v-for="doctor in doctor_List" :key="doctor.id" :value="doctor.doc_id" @click="getDocEvent">{{ doctor.lname }}, {{ doctor.fname }}</option>
              </select>
            </div>
          </div>
          <div class="form-group" v-if="$props.acc_type == 'doctor'">
            <label for="title">Patient Name</label>
            <input type="text" id="title" class="form-control" v-model="newEvent.title" required>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="start">Date</label>
                <input type="date" id="start" class="form-control" v-model="newEvent.start">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="startTime">Time</label>
                <input type="time" id="startTime" class="form-control" v-model="newEvent.startTime">
              </div>
            </div>
            <div class="col-md-6 mb-4" v-if="addingMode">
              <button class="btn btn-sm btn-primary" @click="addNewEvent">Save Event</button>
            </div>
            <template v-else>
              <div class="col-md-6 mb-4">
                <button class="btn btn-sm btn-success" @click="updateEvent">Update</button>
                <button class="btn btn-sm btn-danger" @click="deleteEvent">Delete</button>
                <button class="btn btn-sm btn-secondary" @click="addingMode = !addingMode">Cancel</button>
              </div>
            </template>
          </div>
        </form>
      </div>
      <div class="col-md-8 full-calendar" >
        <Fullcalendar :options="calendarOptions"/>
      </div>
    </div>
  </div>
</template>

<script>
import Fullcalendar from "@fullcalendar/vue";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import interactionPlugin from "@fullcalendar/interaction";
import listPlugin from "@fullcalendar/list";
import axios from "axios";

export default {
  components: {
    Fullcalendar
  },
  props: {
    id: String,
    acc_type: String
  },
  data() {
    return {
      calendarOptions: {
        plugins: [dayGridPlugin, interactionPlugin, timeGridPlugin, listPlugin],
        headerToolbar: {
          start: 'prev today next',
          center: 'title',
          end: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
        },
        initialView: 'dayGridMonth', 
        selectable: true,
        eventOverlap: false,
        eventClick: this.showEventCheck,
        events: []
      },
      allEvents: [],
      newEvent: {
        title: "",
        doc_id: "",
        start: "",
        end: "",
        startTime: "",
        endTime: "",
      },
      doctorList: [
        {
          doc_id: "",
          fname: "",
          lname: "",
          specialization: ""
        }
      ],
      UserDetails: {
        fname: "",
        lname: ""
      },
      specialization: "",
      addingMode: true,
      indexToUpdate: ""
    };
  },
  mounted() {
    this.docList();
    this.getEvents();
    if (this.$props.acc_type == "patient") {
      this.getUserDetails();
    }
    if (this.$props.acc_type == "doctor") {
      this.getDocEvent();
    }
  },
  methods: {
    addNewEvent() {
      if (this.$props.acc_type == "doctor") {
        this.newEvent.doc_id = this.$props.id
      }
      if (this.overlap() != true) {
        axios
        .post("/api/appointment", {
          ...this.newEvent,
          ...this.$props
        })
        .then(data => {
          this.getDocEvent(); // update our list of events
          this.getEvents(); // updates all events
          //this.resetForm(); // clear newEvent properties (e.g. title, start and end)
        })
        .catch(err =>
          console.log("Unable to add new event!", err.response.data)
        );
      } else {
        alert('You cannot add events on the same time and day. Please choose a different time');
      }
      
    },
    showEventCheck(arg) {
      console.log(arg.event._def.extendedProps.user_id);
      if (this.$props.acc_type == "doctor") { // this checks if doctor owns said appointment
        if (this.$props.id == arg.event._def.extendedProps.doc_id) {
          this.showEvent(arg);
        } else {
          this.addingMode = true;
        }
      } else {
        if (this.$props.id == arg.event._def.extendedProps.user_id) { // checks if patient owns said appointment
          this.showEvent(arg);
        } else {
          this.addingMode = true;
        }
      }
    },
    showEvent(arg) {
      this.addingMode = false;
        const { id, title, start, end } = this.calendarOptions.events.find( // find certain event in list
          event => event.id === +arg.event.id
        );
        this.indexToUpdate = id;
        this.newEvent = { // fills up the input fields
          title: title,
          start: start.split(' ')[0],
          doc_id: this.newEvent.doc_id,
          end: end.split(' ')[0],
          startTime: start.split(' ')[1],
          endTime: end.split(' ')[1]
        };
    },
    updateEvent() {
      if (this.overlapUpdate() != true) {
        axios
        .patch("/api/appointment/" + this.indexToUpdate, {
          ...this.newEvent
        })
        .then(data => {
          this.resetForm();
          this.getDocEvent();
          this.getEvents();
          this.addingMode = true;
        })
        .catch(err =>
          console.log("Unable to update event!", err.response.data)
        );
      } else {
        alert('You cannot add events on the same time and day. Please choose a different time');
      }
      
    },
    deleteEvent() {
      axios
        .delete("/api/appointment/" + this.indexToUpdate)
        .then(response => {
          this.resetForm();
          this.getDocEvent();
          this.getEvents();
          this.addingMode = true;
        })
        .catch(err =>
          console.log("Unable to delete event!", err.response.data)
        );
    },
    getEvents() { // gets all appointments regardless of which doctor is chosen
      axios
        .get("/api/appointment")
        .then(response => (this.allEvents = response.data.data))
        .catch(err => console.log(err.response.data));
    },
    getUserDetails() {
      axios
        .get("api/list/" + this.$props.id)
        .then(response => {
          this.UserDetails = response.data.data;
          this.newEvent.title = this.UserDetails[0].fname;
        })
        .catch(err =>
          console.log("Unable to get user data!", err.response.data)
        );
    },
    getDocEvent(arg) { // fetches all events related to said doctor
      this.addingMode = true;
      if (this.$props.acc_type == "doctor") {
        axios
        .get("/api/appointment/" + this.$props.id)
          .then(response => {
            //this.resetForm();
            this.calendarOptions.events = {};
            this.calendarOptions.events = response.data.data;
          })
          .catch(err => console.log(err.response.data));
      } else {
        axios
        .get("/api/appointment/" + this.newEvent.doc_id)
          .then(response => {
            //this.resetForm();
            this.calendarOptions.events = {};
            this.calendarOptions.events = response.data.data;
          })
          .catch(err => console.log(err.response.data));
      }
      
    },
    docList() { // gets all doctors
      axios
        .get("api/list")
        .then(response => (this.doctorList = response.data.data))
        .catch(err => console.log(err.response.data));
    },
    resetForm() { // clears all input fields
      Object.keys(this.newEvent).forEach(key => {
        if (this.newEvent[key] != this.newEvent.doc_id) {
          return (this.newEvent[key] = "");
        }
      });
    },
    overlap() { // checks if events overlap each other
      let i;
      let array = this.allEvents;
      let startTime = this.newEvent.start + ' ' + this.newEvent.startTime;
      let end = new Date("2020-10-10" + ' ' + this.newEvent.startTime);
      end.setMinutes(end.getMinutes() + 30);
      let time = end.toString().split(' ')[4];
      let endTime = this.newEvent.start + ' ' + time;
      for (i in array) {
        if (this.$props.id == array[i].user_id || array[i].doc_id == this.newEvent.doc_id) {
          if (startTime >= array[i].start && startTime < array[i].end) {
            return true;
          } else if (endTime > array[i].start && endTime <= array[i].end) {
            return true;
          }
        }
      }
      return false;
    },
    overlapUpdate() { // checks if events overlap each other when updating
      let i;
      let array = this.allEvents;
      let startTime = this.newEvent.start + ' ' + this.newEvent.startTime;
      let end = new Date("2020-10-10" + ' ' + this.newEvent.startTime);
      end.setMinutes(end.getMinutes() + 30);
      let time = end.toString().split(' ')[4];
      let endTime = this.newEvent.start + ' ' + time;
      for (i in array) {
        if (array[i].id != this.indexToUpdate) {
          if (this.$props.id == array[i].user_id || array[i].doc_id == this.newEvent.doc_id) {
            if (startTime >= array[i].start && startTime < array[i].end) {
              return true;
            } else if (endTime > array[i].start && endTime <= array[i].end) {
              return true;
            }
          }
        }
      }
      return false;
    }
  },
  watch: {
    indexToUpdate() {
      return this.indexToUpdate;
    }
  },
  computed: {
    doctor_List: function() { // filters doctors to match the specialization chosen
      let i;
      let retVal = [];
      let array = this.doctorList
      for (i in array) {
        if (array[i].specialization == this.specialization) {
          retVal.push(array[i]);
        }
      }
      return retVal;
    },
    docListActivated: function() { // simply enables/disables doctor dropdown list
      if (this.doctor_List === undefined || this.doctor_List.length == 0) {
        return true;
      } else {
        return false;
      }
    }
  }
};
</script>

<style lang="css">
/* @import "~@fullcalendar/core/main.css";
@import "~@fullcalendar/daygrid/main.css"; */
.fc-title {
  color: #fff;
}
.fc-title:hover {
  cursor: pointer;
}
</style>