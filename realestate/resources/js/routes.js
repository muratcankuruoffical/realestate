import Home from "./components/Home";
import Login from "./components/user/Login";
import Register from "./components/user/Register";

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
]
