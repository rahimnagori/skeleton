import { useState } from "react";
import { GoChevronDown, GoChevronLeft } from "react-icons/go";

function Accordion({ items }) {
  const [expandedIndex, setExpandedIndex] = useState(-1);

  const renderedItems = items.map((item, index) => {
    const isExpanded = index === expandedIndex;

    const handleClick = () => {
      setExpandedIndex(expandedIndex === index ? -1 : index);
      /*
        # whenever the update value depends on old value like here
        # expandedIndex is set based on it's value, there may be a bug 
        # where the value is not updated to the latest value
        # Try $0.click(); $0.click();
        # It should update the expandedIndex with the latest or second value but
        # the result will be expandedIndex will have the old or the first value.
        # To solve this functional update can be used.
      */
      /*
        # functional update
        # currentExpandedIndex is the latest value in the setter
      */
      /*
      setExpandedIndex((currentExpandedIndex) => {
        return (currentExpandedIndex === index) ? -1 : index;
      });
      */
    };

    const icon = (
      <span className="text-2xl">
        {isExpanded ? <GoChevronDown /> : <GoChevronLeft />}
      </span>
    );

    return (
      <div key={item.id}>
        <div
          className="flex justify-between p-3 bg-gray-200 border-b items-center cursor-pointer"
          onClick={handleClick}
        >
          {item.label}
          {icon}
        </div>
        {isExpanded && <div className="border-p p-5">{item.content}</div>}
      </div>
    );
  });
  return <div className="border-x border-t rounded">{renderedItems}</div>;
}

export default Accordion;
