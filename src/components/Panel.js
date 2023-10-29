import classNames from "classnames";

function Panel({ children, className, ...rest }) {
  /*
        # This component is only returning a div with some common tailwind css
    */
  const finalClassNames = classNames(
    "border rounded p-3 shadow bg-white w-full",
    className
  );

  return (
    <div className={finalClassNames} {...rest}>
      {children}
    </div>
  );
}

export default Panel;
