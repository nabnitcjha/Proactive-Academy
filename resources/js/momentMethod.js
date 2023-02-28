import moment from "moment";
export default {
  data() {
    return {};
  },
  methods: {
    disabledBeforeToday(date) {
      const today = new Date();
      today.setHours(0, 0, 0, 0);
      return date < today;
    },
    time_am_pm(val) {
      return moment(val).format("YYYY-MM-DD hh:mm a");
    },

    start_end_time(start, end) {
      let start_time = moment(start).format("hh:mm:ss a");
      let end_time = moment(end).format("hh:mm:ss a");

      return start_time + "-" + end_time;
    },

    timeAndDate(date, time) {
      return moment(date + " " + time).format("YYYY-MM-DD HH:mm:ss");
    },

    dateAndTimeFormater(val) {
      return moment(val).format("YYYY-MM-DD HH:mm:ss");
    },

    timeFormater(val) {
      return moment(val).format("hh:mm a");
    },
    dateFormater(val) {
      return moment(val).format("YYYY-MM-DD");
    },

    capitalize(text) {
      return text.replace(/\b\w/g, function (m) {
        return m.toUpperCase();
      });
    },
  },
};
