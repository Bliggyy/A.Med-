<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <form @submit.prevent>
          <div class="form-group">
            <label for="title">Appointment Name</label>
            <input type="text" id="title" class="form-control" v-model="newEvent.title">
          </div>
          <div class="form-group">
            <label for="doctors">Doctor List</label>
            <select class="form-control" name="name_of_movie" v-model="newEvent.doc_id">
              <option selected disabled>Choose a doctor</option>
              <option v-for="doctor in doctorList" :key="doctor.id" :value="doctor.doc_id" @click="getDocEvent">{{ doctor.lname }}, {{ doctor.fname }}</option>
            </select>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="start">Date</label>
                <input type="date" id="start" class="form-control" v-model="newEvent.start" >
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="startTime">Time</label>
                <input type="time" id="startTime" class="form-control" v-model="newEvent.startTime" >
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
        eventClick: this.showEvent,
        events: []
      },
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
          lname: ""
        }
      ],
      addingMode: true,
      indexToUpdate: ""
    };
  },
  mounted() {
    //this.getEvents();
    this.docList();
  },
  methods: {
    addNewEvent() {
      if (this.overlap() != true) {
        axios
        .post("/api/appointment", {
          ...this.newEvent
        })
        .then(data => {
          this.getDocEvent(); // update our list of events
          this.resetForm(); // clear newEvent properties (e.g. title, start and end)
        })
        .catch(err =>
          console.log("Unable to add new event!", err.response.data)
        );
      } else {
        alert('You cannot add events on the same time and day. Please choose a different time');
      }
    },
    showEvent(arg) {
      this.addingMode = false;
      const { id, title, start, end } = this.calendarOptions.events.find(
        event => event.id === +arg.event.id
      );
      this.indexToUpdate = id;
      this.newEvent = {
        title: title,
        start: start.split(' ')[0],
        doc_id: this.newEvent.doc_id,
        end: end.split(' ')[0],
        startTime: start.split(' ')[1],
        endTime: end.split(' ')[1]
      };
    },
    findDoctor() {

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
          this.addingMode = true;
        })
        .catch(err =>
          console.log("Unable to delete event!", err.response.data)
        );
    },
    getEvents() {
      axios
        .get("/api/appointment")
        .then(response => (this.calendarOptions.events = response.data.data))
        .catch(err => console.log(err.response.data));
    },
    getDocEvent() {
      this.addingMode = true;
      axios
        .get("/api/appointment/" + this.newEvent.doc_id)
          .then(response => {
            this.resetForm();
            this.calendarOptions.events = {};
            this.calendarOptions.events = response.data.data;
          })
          .catch(err => console.log(err.response.data));
    },
    docList() {
      axios
        .get("api/list")
        .then(response => (this.doctorList = response.data.data))
        .catch(err => console.log(err.response.data));
    },
    resetForm() {
      Object.keys(this.newEvent).forEach(key => {
        if (this.newEvent[key] != this.newEvent.doc_id) {
          return (this.newEvent[key] = "");
        }
      });
    },
    overlap() {
      let i;
      let array = this.calendarOptions.events;
      let startTime = this.newEvent.start + ' ' + this.newEvent.startTime;
      let end = new Date("2020-10-10" + ' ' + this.newEvent.startTime);
      end.setMinutes(end.getMinutes() + 30);
      let time = end.toString().split(' ')[4];
      let endTime = this.newEvent.start + ' ' + time;
      for (i in array) {
        if (startTime >= array[i].start && startTime < array[i].end) {
          return true;
        } else if (endTime > array[i].start && endTime <= array[i].end) {
          return true;
        }
      }
      return false;
    },
    overlapUpdate() {
      let i;
      let array = this.calendarOptions.events;
      let startTime = this.newEvent.start + ' ' + this.newEvent.startTime;
      let end = new Date("2020-10-10" + ' ' + this.newEvent.startTime);
      end.setMinutes(end.getMinutes() + 30);
      let time = end.toString().split(' ')[4];
      let endTime = this.newEvent.start + ' ' + time;
      for (i in array) {
        if (array[i].id != this.indexToUpdate) {
          if (startTime >= array[i].start && startTime < array[i].end) {
            return true;
          } else if (endTime > array[i].start && endTime <= array[i].end) {
            return true;
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