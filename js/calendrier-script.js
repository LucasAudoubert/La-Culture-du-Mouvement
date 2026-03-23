document.addEventListener("DOMContentLoaded", function () {
  var calendarEl = document.getElementById("calendar-design");

  // Stoppe le script si on n'est pas sur la bonne page
  if (!calendarEl) {
    return;
  }

  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: "dayGridMonth",
    locale: "fr",
    height: "100%",
    headerToolbar: {
      left: "title prev,next",
      center: "",
      right: "dayGridMonth,timeGridWeek,timeGridDay",
    },
    buttonText: {
      month: "Mois",
      week: "Semaine",
      day: "Jour",
    },
    firstDay: 1,
    slotMinTime: "08:00:00",
    slotMaxTime: "20:00:00",
    allDaySlot: false,
    dayHeaderFormat: {
      weekday: "long",
    },
    eventDisplay: "block",
    eventTimeFormat: {
      hour: "numeric",
      minute: "2-digit",
      meridiem: false,
    },
    events: {
      url: hexfitData.ajaxUrl, // Variable récupérée depuis functions.php
      format: "ics",
    },
  });
  calendar.render();
});
