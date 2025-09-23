<<<<<<< HEAD
import React from 'react';

const Footer = () => {
    return (
        <div>
            <footer className="main-footer">
=======
import React from "react";

const Footer = (props) => {
    console.log(props);
  return (
    <div>
      <div>
        <footer className="main-footer">
            <div> 
                <h1>{props.p}</h1>
            </div>
>>>>>>> 96993e0f3e623dc7bc2f02a1027775436268fda4
          <div className="float-right d-none d-sm-block">
            <b>Version</b> 3.2.0
          </div>
          <strong>
            Copyright © 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.
          </strong>{" "}
          All rights reserved.
        </footer>
        {/* Control Sidebar */}
        <aside className="control-sidebar control-sidebar-dark">
          {/* Control sidebar content goes here */}
        </aside>
<<<<<<< HEAD
        </div>
    );
};

export default Footer;
=======
        {/* /.control-sidebar */}
        {/* ./wrapper */}
      </div>
    </div>
  );
};

export default Footer;
>>>>>>> 96993e0f3e623dc7bc2f02a1027775436268fda4
