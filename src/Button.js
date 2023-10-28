/*
    # prop-types library can be used to add validation for props as a devDependency.
    # Now TypeScrip can handle the pretty much the same thing.
*/
function Button({
  children,
  primary,
  secondary,
  success,
  warning,
  danger,
  outline,
  rounded,
}) {
  return <button>{children}</button>;
}

export default Button;
