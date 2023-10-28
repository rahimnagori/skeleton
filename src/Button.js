import className from "classnames";
/*
    # prop-types library can be used to add validation for props as a devDependency.
    # Now TypeScript can handle the pretty much the same thing.
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
  const classes = className("px-3 py-1.5 border", {
    "border-blue-500 bg-blue-500 text-white": primary,
    "border-gray-500 bg-gray-500 text-white": secondary,
    "border-green-500 bg-green-500 text-white": success,
    "border-yellow-500 bg-yellow-500 text-white": warning,
    "border-red-500 bg-red-500 text-white": danger,
    "rounded-full": rounded,
    "bg-white": outline,
    "text-blue-500": primary && outline,
    "text-gray-900": secondary && outline,
    "text-green-500": success && outline,
    "text-yellow-400": warning && outline,
    "text-red-500": danger && outline,
  });

  return <button className={classes}>{children}</button>;
}

export default Button;
