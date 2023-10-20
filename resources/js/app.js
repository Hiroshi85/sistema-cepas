import './bootstrap';

import Alpine from 'alpinejs';
import {Calendar} from 'fullcalendar';
import ApexCharts from 'apexcharts';

window.Alpine = Alpine;
window.Calendar = Calendar;
window.ApexCharts = ApexCharts;

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

let config = {
  colors: {
        primary: '#111827',
        secondary: '#8592a3',
        success: '#71dd37',
        info: '#03c3ec',
        warning: '#ffab00',
        danger: '#ff3e1d',
        dark: '#233446',
        black: '#000',
        white: '#F0F0FF', //gray<
        body: '#f4f5fb',
        headingColor: '#566a7f',
        axisColor: '#a1acb8',
        borderColor: '#eceef1'
  }
};

window.config = config;