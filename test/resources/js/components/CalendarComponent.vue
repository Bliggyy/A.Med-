<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <form @submit.prevent>
          <div class="form-group">
            <label for="title">Appointment Name</label>
            <input type="text" id="title" class="form-control" v-model="newEvent.title">
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="start">Start Date</label>
                <input type="date" id="start" class="form-control" v-model="newEvent.start" >
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="end">End Date</label>
                <input type="date" id="end" class="form-control" v-model="newEvent.end">
              </div>
            </div><br>
            <div class="col-md-6">
              <div class="form-group">
                <label for="startTime">Start Time</label>
                <input type="time" id="startTime" class="form-control" v-model="newEvent.startTime" >
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="endTime">End Time</label>
                <input type="time" id="endTime" class="form-control" v-model="newEvent.endTime">
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
        eventClick: this.showEvent,
        events: []
      },
      newEvent: {
        title: "",
        start: "",
        end: "",
        startTime: "",
        endTime: "",
      },
      addingMode: true,
      indexToUpdate: ""
    };
  },
  mounted() {
    this.getEvents();
  },
  methods: {
    addNewEvent() {
      axios
        .post("/api/events", {
          ...this.newEvent
        })
        .then(data => {
          this.getEvents(); // update our list of events
          this.resetForm(); // clear newEvent properties (e.g. title, start and end)
        })
        .catch(err =>
          console.log("Unable to add new event!", err.response.data)
        );
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
        end: end.split(' ')[0],
        startTime: start.split(' ')[1],
        endTime: end.split(' ')[1]
      };
    },
    updateEvent() {
      axios
        .patch("/api/events/" + this.indexToUpdate, {
          ...this.newEvent
        })
        .then(data => {
          this.resetForm();
          this.getEvents();
          this.addingMode = !this.addingMode;
        })
        .catch(err =>
          console.log("Unable to update event!", err.response.data)
        );
    },
    deleteEvent() {
      axios
        .delete("/api/events/" + this.indexToUpdate)
        .then(response => {
          this.resetForm();
          this.getEvents();
          this.addingMode = !this.addingMode;
        })
        .catch(err =>
          console.log("Unable to delete event!", err.response.data)
        );
    },
    getEvents() {
      axios
        .get("/api/events")
        .then(response => (this.calendarOptions.events = response.data.data))
        .catch(err => console.log(err.response.data));
    },
    resetForm() {
      Object.keys(this.newEvent).forEach(key => {
        return (this.newEvent[key] = "");
      });
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