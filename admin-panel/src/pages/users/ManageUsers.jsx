import React from "react";

const ManageUsers = () => {
  return (
    <div>
      {/* <!-- Site wrapper --> */}
      <div className="wrapper">
        {/* Navbar */}
        <Navbar />
        {/* /.navbar */}
        {/* Main Sidebar Container */}
        <Sidebar />
        {/* Content Wrapper. Contains page content */}
        <div className="content-wrapper">
          {/* Content Header (Page header) */}
          <section className="content-header">
            <div className="container-fluid">
              <div className="row mb-2">
                <div className="col-sm-6">
                  <ol className="breadcrumb float-sm-right">
                    <li className="breadcrumb-item">
                      <a href="#">Home</a>
                    </li>
                    <li className="breadcrumb-item active">Blank Page</li>
                  </ol>
                </div>
              </div>
            </div>
            {/* /.container-fluid */}
          </section>
          {/* Main content */}
          <section className="content">
            {/* Default box */}
            <div className="card">
              <div className="card-body">MAnage user</div>
              {/* /.card-body */}
            </div>
            {/* /.card */}
          </section>
          {/* /.content */}
        </div>
        {/* /.content-wrapper */}
        <Footer />
        {/* /.control-sidebar */}
      </div>
      {/* ./wrapper */}{" "}
    </div>
  );
};

export default ManageUsers;
