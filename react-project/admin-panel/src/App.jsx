<<<<<<< HEAD
import React from "react";
import ReactDOM from "react-dom/client";
import { BrowserRouter, Routes, Route } from "react-router";
import Master from "./pages/Master";
import AddUser from "./pages/users/AddUser";
import ManageUsers from "./pages/users/ManageUsers";
const App = () => {
  return (
    <div>
      <BrowserRouter>
        <Routes>
          <Route path="/" element={<Master />} />
          <Route path="/add-user" element={<AddUser />} />
          <Route path="/manage-users" element={<ManageUsers />} />
        </Routes>
      </BrowserRouter>
    </div>
  );
};

export default App;
=======
import ReactDOM from "react-dom/client";
import { BrowserRouter, Routes, Route } from "react-router";
import Header from "./components/Header";
import Master from "./pages/Master";
import Footer from "./components/Footer";
import Sidebar from "./components/Sidebar";
import Home from "./pages/Home";
import AddUser from "./pages/User/AddUser";
import ManageUser from "./pages/User/ManageUser";
import UseState from "./pages/UseState";
import Destructure from "./pages/Destructure";
function App() {
const r="This is footer"
  return (
    <BrowserRouter>
    <Header demo="This is Header"/>
    <Sidebar/>
    <Routes>
      <Route path="/master" element={<Master />} />
      <Route path="/" element={<Home />} />
      <Route path="/add_user" element={<AddUser />} />
      <Route path="/manage_user" element={<ManageUser />} />
      <Route path="/use_state" element={<UseState />} />
      <Route path="/destruct" element={<Destructure />} />
    </Routes>
    <Footer p={r}/>
  </BrowserRouter>
 
  )
}

export default App
>>>>>>> 96993e0f3e623dc7bc2f02a1027775436268fda4
