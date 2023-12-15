import './bootstrap';

import Alpine from 'alpinejs';
import {Calendar} from 'fullcalendar';
import * as dfns from 'date-fns';
import es from 'date-fns/locale/es';
import ApexCharts from 'apexcharts';

window.Alpine = Alpine;
window.Calendar = Calendar;
window.ApexCharts = ApexCharts;
window.dfns = dfns;
window.esdfns = es;

Alpine.start();

import {
    Collapse,
    Ripple,
    // FORMS
    Input,
    Dropdown,
    Select,
    Modal,
    Alert,
    Tab,
    Tooltip,
    initTE,
  } from "tw-elements";

  initTE({
    Collapse,
    Ripple,
    Dropdown,
    Input,
    Select,
    Modal,
    Alert,
    Tooltip,
    Tab,
  });
