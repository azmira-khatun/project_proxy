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
