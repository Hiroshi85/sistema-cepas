import './bootstrap';

import Alpine from 'alpinejs';
import {Calendar} from 'fullcalendar';

window.Alpine = Alpine;
window.Calendar = Calendar;


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