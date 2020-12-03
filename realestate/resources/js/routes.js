import Home from "./components/Home";
import Login from "./components/user/Login";
import Register from "./components/user/Register";
import List from "./components/randevu/List";
import Add from "./components/randevu/Add";
import Edit from "./components/randevu/Edit";

export const routes = [
    {
        name : 'home',
        path : '/',
        component : Home
    },
    {
      name : 'login',
      path : '/login',
      component : Login
    },
    {
        name : 'register',
        path : '/register',
        component : Register
    },
    {
        name : 'randevu_list',
        path : '/randevu/list',
        component : List
    },
    {
        name : 'randevu_add',
        path : '/randevu/add',
        component : Add
    },
    {
        name : 'randevu_edit',
        path : '/randevu/edit/:id',
        component : Edit
    }
]
